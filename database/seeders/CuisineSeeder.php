<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cuisines = array(
            array(
                "name" => "Italian",
                "description" => "Known for its pasta, pizza, and rich sauces like marinara and Alfredo."
            ),
            array(
                "name" => "Chinese",
                "description" => "Famous for its variety of flavors, including sweet, sour, spicy, and savory dishes."
            ),
            array(
                "name" => "Mexican",
                "description" => "Characterized by bold flavors, including tacos, burritos, and salsas with a focus on spices."
            ),
            array(
                "name" => "Indian",
                "description" => "Renowned for its use of spices, including curry dishes, naan bread, and a wide range of vegetarian options."
            ),
            array(
                "name" => "French",
                "description" => "Celebrated for its culinary techniques, pastries, cheeses, and fine wines."
            ),
            array(
                "name" => "Japanese",
                "description" => "Features sushi, ramen, and dishes emphasizing fresh, simple ingredients."
            ),
            array(
                "name" => "Greek",
                "description" => "Known for its use of olive oil, fresh vegetables, and grilled meats, including dishes like moussaka and souvlaki."
            ),
            array(
                "name" => "Thai",
                "description" => "Combines sweet, sour, salty, and spicy flavors, with famous dishes like pad Thai and green curry."
            ),
            array(
                "name" => "Spanish",
                "description" => "Famous for tapas, paella, and a strong focus on seafood and cured meats."
            ),
            array(
                "name" => "Lebanese",
                "description" => "Known for its fresh ingredients, including hummus, tabbouleh, and grilled meats."
            ),
            array(
                "name" => "Turkish",
                "description" => "Features kebabs, mezes, and rich desserts like baklava."
            ),
            array(
                "name" => "Vietnamese",
                "description" => "Famous for its fresh herbs, pho soup, and balance of flavors in dishes."
            ),
            array(
                "name" => "Korean",
                "description" => "Known for its bold flavors, kimchi, and barbecue dishes."
            ),
            array(
                "name" => "Brazilian",
                "description" => "Celebrated for its grilled meats, feijoada, and tropical ingredients."
            ),
            array(
                "name" => "Moroccan",
                "description" => "Features couscous, tagines, and a unique blend of spices."
            ),
            array(
                "name" => "Ethiopian",
                "description" => "Known for its use of injera bread and spiced stews like doro wat."
            ),
            array(
                "name" => "Caribbean",
                "description" => "Features a mix of African, European, and indigenous flavors, including jerk seasoning and fresh seafood."
            ),
            array(
                "name" => "American",
                "description" => "Known for its diverse regional cuisines, including burgers, barbecue, and comfort food."
            ),
            array(
                "name" => "German",
                "description" => "Famous for its sausages, pretzels, and hearty dishes like schnitzel and sauerkraut."
            ),
            array(
                "name" => "Russian",
                "description" => "Characterized by hearty soups, stews, and traditional dishes like borscht and blini."
            )
        );

        foreach ($cuisines as $cuisine) {
            \App\Models\Cuisine::create([
                'name' => $cuisine['name'],
                'slug' => \Illuminate\Support\Str::slug($cuisine['name']),
                'description' => $cuisine['description'],
                'status' => true
            ]);
        }
    }
}
