<?php

namespace Modules\MenuItems\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\MenuItems\Entities\MenuItem;
use Modules\MenuItems\Entities\MenuItemOption;
use Modules\MenuItems\Transformers\MenuItemResource;

class MenuItemsController extends Controller
{
    private $validation_rules = [
        'file' => 'required|mimes:json'
    ];

    private function basicResponse(): array
    {
        return [
            'status' => 200,
            'message' => '',  // hold error message
            'results' => []  // have values only for show and get all menu items
        ];
    }

    private $response;

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->response = $this->basicResponse();
    }

    /**
     * read data from json file and saved to menu items
     * @param Request $request
     * @return JsonResponse
     */
    public function store (Request $request): JsonResponse
    {
        $validator = $this->getValidationFactory()->make($request->all(), $this->validation_rules);

        if ($validator->fails()) {
            $this->response['status'] = 422;
            $this->response['message'] = $validator->errors();
        } else {
            try {
                $file = $request->file;
                $items = json_decode(file_get_contents($file->getRealPath()));

                foreach ($items->MenuItems as $key=>$value) {

                    $menuItem = MenuItem::create([
                        "name" => $value->ItemName,
                        "description" => $value->ItemDescription,
                        "price" => $value->price
                    ]);

                    foreach ($value->ItemOptions as $option) {
                        $menuItem->menuItemOptions()->save(new MenuItemOption(["name" => $option->Name,
                            "maxQty" => $option->MaxQty, "price" => $option->Price]));
                    }

                }

                $this->response['message'] = 'menu data saved successfully!';

            } catch (\Throwable $th) {
                $this->response['status'] = 500;
                $this->response['message'] = $th->getMessage();
            }
        }
        return response()->json($this->response);
    }

    /**
     * show all menu items
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $items = MenuItem::get();
            $this->response['results'] = MenuItemResource::collection($items);
        } catch (\Throwable $th) {
            $this->response['status'] = 500;
            $this->response['message'] = $th->getMessage();
        }
        return response()->json($this->response);
    }

    /**
     * show one item
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $validator = $this->getValidationFactory()->make(['id' => $id], ['id' => 'required|numeric|exists:menu_items']);
        if ($validator->fails()) {
            $this->response['status'] = 422;
            $this->response['message'] = $validator->errors();
        } else {
            try {
                $item = MenuItem::find($id);
                $this->response['results'] = new MenuItemResource($item);
            } catch (\Throwable $th) {
                $this->response['status'] = 500;
                $this->response['message'] = $th->getMessage();
            }
        }
        return response()->json($this->response);

    }

    /**
     * delete one menu item
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $validator = $this->getValidationFactory()->make(['id' => $id], ['id' => 'required|numeric|exists:menu_items']);
        if ($validator->fails()) {
            $this->response['status'] = 422;
            $this->response['message'] = $validator->errors();
        } else {
            try {
                $item = MenuItem::find($id);
                $item->menuItemOptions()->delete();
                if ($item->delete()) {
                    $this->response['message'] = 'menu data removed successfully!';
                } else {
                    $this->response['status'] = 500;
                    $this->response['message'] = 'menu data failed to remove!';
                }
            } catch (\Throwable $th) {
                $this->response['status'] = 500;
                $this->response['message'] = $th->getMessage();
            }
        }

        return response()->json($this->response);
    }

}
