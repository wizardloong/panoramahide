<?php

namespace Tests\Unit\Controllers;


use App\Http\Controllers\PromoController;
use App\Promocode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PromoControllerTest extends TestCase
{

    /**
     * Запрос несуществующего промокода
     */
    public function testAccessWrongPromocode()
    {
        $oPromoController = (new PromoController());

        $request = new Request();
        $request->merge([
            'promocode' => $this->promocode(), // несуществующий промокод
        ]);
        $result = $oPromoController->access($request);

        $this->assertFalse($result['success']);
    }

    /**
     * Запрос несуществующего промокода
     */
    public function testAccessPromocode()
    {
        $oPromoController = (new PromoController());
        $request = new Request();

        $oPromoCode = $this->activePromocode();

        $user = $this->user();
        if (Auth::guest()) {
            // вывод модального окна с просьбой авторизоваться
            $request->merge([
                'promocode' => $oPromoCode->promocode, // существующий промокод
                'email' => $user->email,
            ]);
            $result = $oPromoController->access($request);
            $this->assertFalse($result['success']);
        }
        // авторизация
        $this->actingAs($user);
        $this->assertAuthenticated();


        $request->merge([
            'promocode' => $oPromoCode->promocode, // существующий промокод
            'phone' => $this->phone()
        ]);

        // полуение кода подтверждения
        DB::transaction(function () use ($oPromoController, $request) {
            $result = $oPromoController->access($request);
            $this->assertTrue($result['success']);

            $this->assertIsInt($result['code']);

            DB::rollBack();
        });
    }

    /**
     * - проверка несуществующего промокода
     * - проверка неверного кода подтверждения по телефону
     */
    public function testCodeWrongCode()
    {
        $oPromoController = (new PromoController());

        $request = new Request();
        $request->merge([
            'promocode' => $this->promocode(), // несуществующий промокод
        ]);
        $result = $oPromoController->code($request);
        $this->assertFalse($result['success']);

        $oPromoCode = $this->activePromocode();

        $request->merge([
            'promocode' => $oPromoCode->promocode, // существующий промокод
            'phone' => $this->phone(), // несуществующий телефон
            'code' => $this->promocode(), // несуществующий код подтверждения
        ]);

        $this->assertFalse($result['success']);


        // полуение кода подтверждения
        DB::transaction(function () use ($oPromoController, $request, $oPromoCode) {

            $user = $this->user();
            // авторизация
            $this->actingAs($user);
            $this->assertAuthenticated();

            $result = $oPromoController->access($request);

            $this->assertTrue($result['success']);

            $this->assertIsInt($result['code']);

            $request->merge([
                'promocode' => $oPromoCode->promocode, // существующий промокод
                'phone' => $this->phone(), // несуществующий телефон
                'code' => $result['code'], // существующий код подтверждения
            ]);
            $result = $oPromoController->code($request);

            $this->assertTrue($result['success']);
            DB::rollBack();
        });


    }

    /**
     * - проверка несуществующего промокода перед входом
     * - проверка неверного кода подтверждения по телефону
     */
    public function testPasswordWrongPassword()
    {
        $oPromoController = (new PromoController());

        $request = new Request();
        $request->merge([
            'promocode' => $this->promocode(), // несуществующий промокод
        ]);

        $oPromoCode = $this->activePromocode();

        $request->merge([
            'promocode' => $oPromoCode->promocode, // несуществующий промокод
            'email' => 'user_wrong@user.com', // несуществующий email
            'password' => '1234567890',
        ]);

        $result = $oPromoController->password($request);

        $this->assertFalse($result['success']);
    }

    /**
     * Запрос несуществующего промокода для активации
     */
    public function testActivationWrongActivation()
    {
        $oPromoController = (new PromoController());

        $request = new Request();
        $request->merge([
            'promocode' => $this->promocode(), // несуществующий промокод
        ]);
        $result = $oPromoController->access($request);

        $this->assertFalse($result['success']);
    }


    /**
     * Активный промокод
     * - release_end > now()
     * - active = 1
     * - used < limit
     *
     * @return mixed
     */
    private function activePromocode()
    {
        $oPromoCodes = Promocode::where('release_end', '>', now())
            ->where('active', 1)
            ->get();
        $oPromoCodes = $oPromoCodes->reject(function ($item) {
            return $item->used >= $item->limit;
        });
        return $oPromoCodes->first();
    }

    /**
     * Тестовый пользователь
     *
     * @return mixed
     */
    private function user()
    {
        return User::first();
    }

    /**
     * Неверный телефон
     *
     * @return int
     */
    private function phone()
    {
        return 79998887766;
    }

    /**
     * Неверный промокод
     *
     * @return string
     */
    private function promocode()
    {
        return '2--------2';
    }
}
