<?php
use Illuminate\Http\UploadedFile;
use Modules\MenuItems\Entities\MenuItem;
use Modules\MenuItems\Entities\MenuItemOption;

class MenusTest extends TestCase
{
    public function testCanCreateMenuItem()
    {
        $local_file = public_url('/uploads/menu.json');

        $uploadedFile = new UploadedFile(
            $local_file,
            'menu.json',
            'json',
            null,
            true
        );

        $this->post('/api/v1/menuItems', ['file' => $uploadedFile])
            ->seeJsonEquals([
                'status' => 200,
                'message' => 'menu data saved successfully!',
                "results" => []
            ]);

    }

    public function testCanShowMenuItem()
    {

        $item = MenuItem::create([
            'name' => 'test name',
            'description' => 'test desc',
            'price' => 100
        ]);
        $item->menuItemOptions()->save(new MenuItemOption(["name" => 'option', 'maxQty' => 100, "price" => 120]));

        $this->get('/api/v1/menuItems/'.$item->id)
            ->assertResponseStatus(200);
    }

    public function testCanShowMenuItems()
    {

        $this->get('/api/v1/menuItems/')
            ->assertResponseStatus(200);
    }

    public function testDeleteMenuItem()
    {

        $item = MenuItem::create([
            'name' => 'test name',
            'description' => 'test desc',
            'price' => 100
        ]);

        $this->delete('api/v1/menuItems/' . $item->id)
            ->assertResponseStatus(200);
    }
}
