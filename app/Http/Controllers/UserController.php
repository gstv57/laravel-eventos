<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Exception;
use App\Models\User;
use App\Models\UserContactInfo;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function index()
    {
        try {
            $user = auth()->user();
            $contactInfo = $user->contactInfo;
            $transactions = Transaction::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->simplePaginate(3);
            $account = BankAccount::where('user_id', $user->id)->first();
            return view('profile.profile', [
                'contactInfo' => $contactInfo,
                'user' => $user,
                'transactions' => $transactions,
                'account' => $account
            ]);
        } catch (\Throwable $th) {
            return redirect('/profile')->with('msg', 'Aconteceu algum problema ao tentar acessar o perfil, contate o suporte.');
        }
    }

    public function create()
    {
        try {
            $user = auth()->user();
            return view('profile.create', [
                'user' => $user
            ]);
        } catch (Exception $e) {
            return redirect('/profile')->with('msg', 'Falha ao acessar a crição do perfil, entre em contato com o suporte');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => 'required|max:255',
            "phone" => 'required|max:20',
            "address" => 'required|max:255',
            "address_number" => 'required|max:10',
            "neighborhood" => 'required|max:30',
            "city" => 'required|max:20',
            "state" => 'required|max:20',
            "zip" => 'required|max:8'
        ]);

        DB::beginTransaction();

        try {


            $user = auth()->user();
            $contactInfo = new UserContactInfo();

            $contactInfo->user_id = $user->id;
            $contactInfo->phone = $request->phone;
            $contactInfo->address = $request->address;
            $contactInfo->address_number = $request->address_number;
            $contactInfo->neighborhood = $request->neighborhood;
            $contactInfo->city = $request->city;
            $contactInfo->country = $request->country;
            $contactInfo->state = $request->state;
            $contactInfo->zip = $request->zip;

            $firstTable = [
                'name' => $request->name,
            ];
            User::where('id', $user->id)->update($firstTable);

            $contactInfo->save();

            DB::commit();

            return redirect('/profile')->with('msg', 'Informações de contato criado com sucesso');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/profile')->with('msg', 'Falha ao criar informações de contato, entre em contato com o suporte');
        }
    }

    public function edit()
    {
        try {
            $user = auth()->user();
            $contactInfo = $user->contactInfo;
            return view('profile.edit', [
                'user' => $user,
                'contactInfo' => $contactInfo
            ]);
        } catch (\Throwable $th) {
            return redirect('/profile')->with('msg', 'Aconteceu algum problema ao tentar editar o perfil, contate o suporte.');
        }
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            "name" => 'required|max:255',
            "phone" => 'required|max:255',
            "address" => 'required|max:255',
            "address_number" => 'required|max:255',
            "neighborhood" => 'required|max:255',
            'city' => 'required|max:255',
            "state" => 'required|max:255',
            "zip" => 'required|max:255'
        ]);

        DB::beginTransaction();

        try {

            $user = auth()->user();
            $contactInfo = $user->contactInfo;

            $firstTable = [
                'name' => $request->name,
            ];
            User::where('id', $user->id)->update($firstTable);

            $secondTable = [
                'phone' => $request->phone,
                'address' => $request->address,
                'address_number' => $request->address_number,
                'neighborhood' => $request->neighborhood,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip
            ];

            $contactInfo->update($secondTable);

            DB::commit();

            return redirect('/profile')->with('msg', 'Perfil atualizado com sucesso');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/profile')->with('msg', 'Perfil não atualizado, entre em contato com o suporte');
        }
    }

    public function accountBankGet()
    {
        try {
            $user = auth()->user();

            if (BankAccount::where('user_id', $user->id)->count() >= 1) {
                abort(404);
            }

            return view('profile.bankAccount', [
                'user' => $user
            ]);
        } catch (Exception $e) {
            return redirect('/profile')->with('msg', 'Falha ao acessar a crição do perfil bancário, entre em contato com o suporte');
        }
    }

    public function accountBankRegister(Request $request)
    {

        $validated = $request->validate([
            "agency" => 'required|max:5',
            "account" => 'required|max:11',
            "bank" => 'required|max:255',
        ]);


        Db::beginTransaction();

        try {

            $user = auth()->user();

            if (BankAccount::where('user_id', $user->id)->count() >= 1) {
                abort(404);
            }

            $agency = $request->agency;
            $account = $request->account;
            $bank = $request->bank;

            $newAccountBank = new BankAccount();
            $newAccountBank->user_id = $user->id;
            $newAccountBank->agency = $agency;
            $newAccountBank->account = $account;
            $newAccountBank->bank = $bank;
            $newAccountBank->save();

            DB::commit();

            return redirect('/profile')->with('msg', 'Informações bancárias registradas com sucesso. Caso precise alterar os dados, entre em contato com o suporte.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/profile')->with('msg', 'Informações bancárias não registradas. Entre em contato com o suporte.');
        }
    }
}
