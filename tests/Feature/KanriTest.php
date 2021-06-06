<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Kanri;

class KanriTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_before()
    {   
        //rootへアクセスした際、indexViewを返す
        $response = $this->get('/')->assertStatus(200)->assertViewIs('index');
        
        //新規登録ページへアクセスできる
        $response = $this->get('register')->assertStatus(200)->assertViewIs('auth.register');
        
        //ログインページへアクセスできる
        $response = $this->get('login')->assertStatus(200)->assertViewIs('auth.login');       
        
        //未ログイン状態で新規投稿ページへアクセスすると、ログインページへリダイレクトする
        $response = $this->get('create')->assertStatus(302)->assertRedirect('http://localhost/login');         
    }

    public function test_register_login()
    {
        //ユーザ新規登録ができる
        $response = $this->from('/')->post(route('register') ,[    
        'name' => 'test',
        'email' => 'test@gmail.com',
        'password' => 'aaaa1111',
        'password_confirmation' => 'aaaa1111',
        ])->assertStatus(302)->assertRedirect('/');

        //ユーザ新規登録したデータでログインができる
        $response = $this->from('/')->post(route('login') ,[    
        'name' => 'test',
        'password' => 'aaaa1111',
        ])->assertStatus(302)->assertRedirect('/');
    }   

    public function test_login_after()
    {
        //ユーザ情報を生成
        $user = User::factory()->create();

        //ログイン状態で新規登録ページへアクセスすると、rootへリダイレクトする
        $response = $this->actingAs($user)->get('register')->assertStatus(302)->assertRedirect('/');

        //ログイン状態でログインページへアクセスすると、rootへリダイレクトする
        $response = $this->actingAs($user)->get('login')->assertStatus(302)->assertRedirect('/');

        //ログイン状態で新規投稿ページへアクセスできる
        $response = $this->actingAs($user)->get('create')->assertStatus(200)->assertViewIs('create');

        //ログイン状態で新規投稿ができる
        $response = $this->post(route('store') ,[    
        'bikou' => 'テストです',
        'info' => '出勤',
        'user_id' => $user->id,
        ])->assertStatus(302)->assertRedirect('/');

        //ログイン状態で新規投稿後、新規投稿ページへアクセスするとrootへリダイレクトする
        $response = $this->actingAs($user)->get('create')->assertStatus(302)->assertRedirect('/');

        //ログイン状態で新規投稿後、退勤入力ページへアクセスできる
        $response = $this->actingAs($user);
        $kanri = Kanri::factory()->create();
        $id = $kanri->id;
        $response = $this->actingAs($user)->get(route('edit',$id));;
       
        
        






        //ログイン状態で新規投稿ができる
        // $response = $this->post(route('store') ,[    
        // 'bikou' => 'テストです',
        // 'info' => '出勤',
        // 'user_id' => $user->id,
        // ])->assertStatus(302)->assertRedirect('/');


    }

}
