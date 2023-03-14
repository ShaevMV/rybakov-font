<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Jobs\SendMailActivateJob;
use App\Jobs\SendMailRestorePassword;
use App\Models\Organization;
use App\Models\PasswordResets;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    const TOKEN_TYPE = 'Bearer';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user()
            ->load(Organization::TABLE);
        return response()->json([
            'user' => $user,
            'countNotification' => $user->unreadNotifications->count()
        ]);
    }

    /**
     * Вывести список
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        return response()->json([
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RegistrationUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrationUserRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'role_id' => $request->get('userType') ? Role::ID_USER : Role::ID_KINDERGARTEN,
            'position' => $request->get('position'),
            'password' => bcrypt($request->get('password'))
        ]);

        if(!$request->get('userType') || $request->get('staff')){
            $organization = Organization::create([
                'name_organization' => !$request->get('userType') ? $request->get('organization') : $request->get('kindergarten'),
                'address' => !$request->get('userType') ? $request->get('address') : $request->get('kindergartenAddress')
            ]);
            $user->organizations()->associate($organization);
            $user->save();
        }

        dispatch((new SendMailActivateJob($user))
            ->onConnection('database')
            ->delay(5));

        return response()->json([
            'message' => 'На указанный почтовый ящик выслано письмо со ссылкой для подтверждения регистрации. Подтвердите почтовый адрес, пройдя по ссылке в письме'
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(UpdateUserRequest $request)
    {

        $users = $request->get('users');
        $user = \Auth::user();
        if(isset($users['password'])){
            $users['password'] = bcrypt($users['password']);
        }
        $user->update($users);

        if ($request->get('staff')) {
            $organization = $request->get('organizations');
            if ($user->organization_id == null) {
                $organizations = Organization::create($organization);
                $user->organizations()->associate($organizations);
                $user->save();
            } else {
                $user->organizations()->update($organization);
            }
        } else {
            $user->organizations()->dissociate()->save();
            if(isset($request->get('organizations')['id'])){
                Organization::find($request->get('organizations')['id'])->delete();
            }
        }

        $user = User::with((new Organization())->getTable())
            ->where('id', '=', $users['id'])->first();

        return response()->json(
            $user
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id)->delete();
            return response()->json(
                $user
            );
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ],420);
        }
    }

    /**
     * Проверить что пользователь
     *
     * @param int $idUser
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function userActivation(int $idUser, string $token)
    {
        $user = User::findOrFail($idUser);
        $result = false;

        if(md5($user->email) == $token){
            $user->markEmailAsVerified();
            $result = true;
        }
        return response()->json([
            'active' => $result
        ]);
    }

    /**
     * Отправить ссылку на восстановления пароля
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function restorePassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email'
        ], [
            '*.required' => 'Поле обязательно для ввода',
            '*.email' => 'Поле должно быть email'
        ]);
        $validate->validate();
        $email = $request->get('email');
        if ($user = User::where('email', '=', $email)->first()) {
            dispatch((new SendMailRestorePassword($user))
                ->onConnection('database')
                ->delay(5));

            return response()->json([
                'message' => 'На указанный емейл отправлена ссылка для восстановления пароля'
            ]);
        } else {

            return response()->json([
                'errors' => [
                    'email' => ['Данный пользователь в системе не зарегистрирован']
                ]
            ], 422);
        }
    }

    public function changePassword(Request $request)
    {
        Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
            'token' => 'required'
        ], [
            '*.required' => 'Поле обязательно для ввода',
            '*.min' => 'Минимальное количествво симвалов 6-ть',
            '*.confirmed' => 'Пароль не совпадает'
        ])->validate();

        $userPasswordResets = PasswordResets::whereToken($request->get('token'))->first();
        $user = User::whereEmail($userPasswordResets->email)->first();
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return response()->json([
            'token_type' => self::TOKEN_TYPE,
            'access_token' => $user->createToken('Token Name')->accessToken
        ]);
    }
}
