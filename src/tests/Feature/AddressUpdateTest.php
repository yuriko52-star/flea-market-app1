<?php

namespace Tests\Feature;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Profile;

class AddressUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /*public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    */

    public function testAddressIsUpdatedAndCorrectlySavedWhenPurchasing()
    {
        $user = User::factory()->create();
        $user->profile()->create([
        'address' => '東京都渋谷区',
        'post_code' => '123-4567',
        'building' => '渋谷タワー10F',
        'img_url' => '/storage/images/user-profile.jpg',
        ]);

        $item = Item::factory()->create();

        $updateAddress = [
            'shipping_address' => '東京都新宿区',
            'shipping_post_code' => '147-2583',
            'shipping_building' => '新宿ビル6階',
        ];

        $response = $this->actingAs($user)->post(route('purchase.address.update', ['item_id' => $item->id]), $updateAddress);
        $response->assertStatus(302);

        $response = $this->actingAs($user)->get(route('purchase.show', ['item_id' => $item->id]));

        $response->assertSee('東京都新宿区');
        $response->assertSee('147-2583');
        $response->assertSee('新宿ビル6階');

         $this->actingAs($user)->post(route('purchase.store'), [
            'item_id' => $item->id,
            'payment_method' => 'card',
            'shipping_address' => '東京都新宿区',  
            'shipping_post_code' => '147-2583',  
            'shipping_building' => '新宿ビル6階',
          ]);
        dump(DB::table('purchases')->get());

        $purchase = Purchase::where('user_id', $user->id)->where('item_id', $item->id)->firstOrFail();
        $purchase->refresh(); 
        $this->assertDatabaseHas('purchases' ,[
             'user_id' => $user->id,
             'item_id' => $item->id,
             'shipping_address' => '東京都新宿区',
             'shipping_post_code' => '147-2583',
             'shipping_building' => '新宿ビル6階',
             'payment_method' => 'card',
        ]);
    }
}
