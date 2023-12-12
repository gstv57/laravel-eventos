<?php

namespace App\Http\Controllers;

use App\Models\{Event, Transaction, User};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $events = Event::where([
                ['title', 'like', '%' . $search . '%'],
                ['finished', false],
            ])->get();
        } else {
            $events = Event::where('finished', false)->get();
        }

        return view('home', [
            'events' => $events,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "image"       => 'required|extensions:jpg,png,jpeg',
            "title"       => 'required|max:255',
            "date"        => 'required|date|after_or_equal:today',
            "city"        => 'required|max:255',
            "private"     => 'required|max:1',
            "description" => 'required|max:255',
            "price"       => 'decimal:2',
        ]);

        DB::beginTransaction();

        try {
            $user_id          = auth()->user()->id;
            $event            = new Event();
            $event->user_id   = $user_id;
            $event->wallet_id = $user_id;

            $event->title       = $request->title;
            $event->date        = $request->date;
            $event->city        = $request->city;
            $event->private     = $request->private;
            $event->description = $request->description;
            $event->items       = $request->items;
            $event->price       = $request->price;

            //validate photo format and has file
            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $requestImage = $request->image;
                $extension    = $requestImage->extension();
                $imageName    = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
                $requestImage->move(public_path('img/events'), $imageName);
                $event->image = $imageName;
            }

            $event->save();
            DB::commit();

            return redirect('/')->with('msg', 'Evento criado com sucesso!');

        } catch (Throwable) {
            DB::rollBack();

            return redirect('/')->with('msg', 'Erro ao cadastrar o evento. Por favor entre em contato com o suporte.');
        }
    }

    public function show($id)
    {

        $event = Event::FindOrFail($id);
        $user  = auth()->user();

        $hasUserJoined = false;

        if ($user) {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach ($userEvents as $item) {
                if ($item['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard()
    {
        try {
            $user = auth()->user();

            $events = $user->events;

            $eventsAsParticipant = $user->eventsAsParticipant;

            return view('events.dashboard', [
                'events'              => $events,
                'eventsAsParticipant' => $eventsAsParticipant,
            ]);
        } catch (Exception) {
            return redirect('/events/create')->with('msg', 'Você precisa criar um evento antes de poder acessar Meus Eventos');
        }
    }

    public function destroy($id)
    {
        $user  = auth()->user();
        $event = Event::findOrFail($id);

        if ($user->id == $event->user->id) {
            Event::findOrFail($id)->delete();
        } else {
            return redirect('/dashboard')->with('msg', 'Você não tem permissão para excluir esse evento.');
        }

        return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso!');
    }

    public function edit($id)
    {
        $user  = auth()->user();
        $event = Event::findOrFail($id);

        if ($user->id != $event->user->id) {
            return redirect('/dashboard')->with('msg', 'Você não tem permissão para editar esse evento.');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            "title"       => 'required|max:255',
            "date"        => 'date',
            "city"        => 'required|max:255',
            "private"     => 'required|max:1',
            "description" => 'required|max:4000000',
            'image'       => 'mimes:jpg,bmp,png',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->all();

            // if update image
            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $requestImage = $request->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;

                $requestImage->move(public_path('img/events'), $imageName);

                $data['image'] = $imageName;
            }

            Event::findOrFail($request->id)->update($data);

            DB::commit();

            return redirect('/')->with('msg', 'Evento atualizado com sucesso!');
        } catch (Throwable) {
            DB::rollBack();

            return redirect('/')->with('msg', 'Erro ao atualizar o evento. Por favor entre em contato com o suporte.');
        }
    }

    public function joinEvent($id)
    {
        DB::beginTransaction();

        try {
            $user  = auth()->user();
            $event = Event::findOrFail($id);

            if($user->id === $event->user_id) {
                return redirect('/');
                // inserir mensagem para que donos de eventos, não participem do proprio evento =)
            }

            if ($event->price == 0 || $user->wallet->balance >= $event->price) {

                $user->eventsAsParticipant()->attach($id);
                $event->update(['attended' => true]);

                if ($event->price > 0) {
                    $user->wallet->decrement('balance', $event->price);
                    $event->wallet->increment('balance', $event->price);
                }

                // user
                Transaction::create([
                    'user_id'  => auth()->user()->id,
                    'event_id' => $id,
                    'amount'   => $event->price,
                    'type'     => 'debito',
                ]);

                // owner Event
                Transaction::create([
                    'user_id'  => $event->user_id,
                    'event_id' => $id,
                    'amount'   => $event->price,
                    'type'     => 'credito',
                ]);

                DB::commit();

                return redirect('/')->with('msg', 'Sua presença está confirmada no evento: ' . $event->title);
            } else {
                DB::rollBack();

                return redirect('/')->with('msg', 'Saldo insuficiente para participar do evento ' . $event->title . '. Por favor, recarregue sua carteira.');
            }
        } catch (Throwable) {
            DB::rollBack();

            return redirect('/')->with('msg', 'Erro ao confirmar presença no evento. Por favor entre em contato com o suporte.');
        }
    }

    public function leaveEvent($id)
    {

        DB::beginTransaction();

        try {
            $user  = auth()->user();
            $event = Event::findOrFail($id);

            $user->eventsAsParticipant()->detach($id);
            $event->update(['attended' => false]);

            if ($event->price > 0) {
                $user->wallet->increment('balance', $event->price);
                $event->wallet->decrement('balance', $event->price);
            }

            // user
            Transaction::create([
                'user_id'  => auth()->user()->id,
                'event_id' => $id,
                'amount'   => $event->price,
                'type'     => 'credito_estorno',
            ]);

            // owner event
            Transaction::create([
                'user_id'  => $event->user_id,
                'event_id' => $id,
                'amount'   => $event->price,
                'type'     => 'estorno',
            ]);

            DB::commit();

            return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento: ' . $event->title);
        } catch (Throwable) {
            DB::rollBack();

            return redirect('/')->with('msg', 'Erro ao sair do evento. Por favor entre em contato com o suporte.');
        }
    }

    public function finishEvent($id)
    {

        DB::beginTransaction();

        try {

            $event = Event::FindOrFail($id);
            $user  = auth()->user();

            // verify if user is owner event
            if ($user->id != $event->user->id) {
                return redirect('/dashboard')->with('msg', 'Você não tem permissão para finalizar este evento.');
            }

            // verify if event has finished
            if ($event->finished) {
                return redirect('/dashboard')->with('msg', 'Este evento já foi finalizado.');
            }

            $event->update(['finished' => true]);
            DB::commit();

            return redirect('/dashboard')->with('msg', 'O Evento ' . $event->title . ' foi finalizado com sucesso.');
        } catch (Throwable) {
            DB::rollBack();

            return redirect('/')->with('msg', 'Erro ao finalizar o evento. Por favor entre em contato com o suporte.');
        }
    }
}
