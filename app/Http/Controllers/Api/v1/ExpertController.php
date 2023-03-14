<?php

namespace App\Http\Controllers\Api\v1;

use App\Container\Expert\ExpertsContainer;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationUserRequest;
use App\Jobs\SendMailActivateJob;
use App\User;

class ExpertController extends Controller
{
    /**
     * Вывести список экспертов
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExpertsList()
    {
        return response()->json([
            'experts' => (new ExpertsContainer())
                ->getList()->get()
        ]);
    }

    /**
     * Добавить эксперта
     *
     * @param RegistrationUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addExpert(RegistrationUserRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'role_id' => $request->get('role_id'),
            'password' => bcrypt($request->get('password'))
        ]);

        dispatch((new SendMailActivateJob($user))
            ->onConnection('database')
            ->delay(5));

        return response()->json([
            'user' => $user
        ]);
    }
}
