
# Menu Items API Service lumen
A REST APIs that ingests json files, parses data and store them in a database, endpoints to display menu items and delete one menu item

## Installation

Please check the official lumen installation guide for server requirements before you start. [lumen 8 Documentation](https://lumen.laravel.com/docs/8.x)

Clone the repository using terminal

    git clone https://github.com/maysaahmed/order-menus.git

Switch to the repo folder

    cd order-menus

Install all the dependencies using composer

    composer install

Generate a new application key

    php artisan key:generate

Set the database connection in .env
   
    DB_DATABASE=database_name
    DB_USERNAME=database_user_name
    DB_PASSWORD=database_password
    
Run the database migrations to create 2 table -> menu_items and menu_item_options (**Set the database connection in .env before migrating**)

    php artisan migrate


## JSON file structure

    {
      "MenuItems": [
        {
          "ItemName": "pasta",
          "ItemDescription":"cheese, chicken",
          "price": 100,
          "ItemOptions": [{
            "Name": "medium",
            "MaxQty": 120,
            "Price": 100
          },{
              "Name": "small",
              "MaxQty": 100,
              "Price": 80
          }]
        }
      ]
    }


## Menu Items Endpoints

You can upload json file to create menu items 

    POST {base_url}/api/v1/menuItems
    
    
You can list all menus items you have in the database through

    Get  {base_url}/api/v1/menuItems
    
To can get one menu item use:
    
    Get  {base_url}/api/v1/menuItems/1
    
    1 -> menu item id


You can also delete menu item 

    DELETE {base_url}/api/v1/menuItems/1
