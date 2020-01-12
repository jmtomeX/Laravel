<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Opinion;
use App\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $category = new Category();
        $category->titulo = 'General';
        $category->save();

        DB::table('products')->insert([
            [
            'producto' => 'Portátil - HP 15-DB1001NS, 15.6" HD, AMD Ryzen™ 3 3200U, 8 GB RAM, 256 GB, W10, Negro',
            'descripcion' => 'Descubre las ventajas de HP que quiere darte recursos para que puedas desarrollar tus tareas informáticas, por eso que ofrece el ordenador con procesador AMD Ryzen™ 3 3200U que hará que tu vida al momento de realizar trabajos sea mucho más fácil, con la combinación de todos sus componentes internos hará que todas tus instrucciones se ejecuten en el menor tiempo posible dándote más tiempo para que aproveches en otras gestiones. ',
            'precio' => '499.50',
            'category_id' => $category->id,
            ],
            [
            'producto' => 'Portátil - HP 14-df0003ns, 14" Full HD, Intel® Celeron® N4000, 4GB RAM, 64GB eMMC, Windows 10 Home, Blanco',
            'descripcion' => 'El portátil HP 14-df0003ns con pantalla de 14" Full HD y en color blanco copo de nieve tiene un diseño ligero y fino y con él podrás realizar todas tus tareas gracias a su procesador y su batería de larga duración (hasta 10 horas y media).',
            'precio' => '699',
            'category_id' => $category->id,
            ],
            [
            'producto' => 'PC Sobremesa - Lenovo Ideacentre 510S-07ICB, Intel® Core™ i3-8100, 8 GB RAM, 1TB, Intel® UHD Graphics 630, W10',
            'descripcion' => 'Si necesitas un equipo para tus tareas cotidianas tales como trabajar, estudiar, o consultar tu correo electrónico y páginas webs preferidas, con este PC sobremesa Lenovo Ideacentre 510S-07ICB tendrás todo lo que buscas. Práctico y ágil para tu día a día.',
            'precio' => '799',
            'category_id' => $category->id,
            ],
            [
            'producto' => 'All in One - Lenovo IdeaCentre 520-24ARR, 23.8", AMD R5-2400GE, 8 GB RAM, 256 GB, W10',
            'descripcion' => 'Si necesitas un equipo para tus tareas cotidianas tales como trabajar, estudiar, o consultar tu correo electrónico y páginas webs preferidas, con este All in One Lenovo 520-24ARR tendrás todo lo que buscas. Práctico y ágil para tu día a día.',
            'precio' => '759',
            'category_id' => $category->id,
            ],
        ]);

        $product = new Product();
        $product->producto = 'Test para opiniones';
        $product->descripcion = 'Si necesitas un equipo para tus tareas cotidianas t';
        $product->precio = '123';
        $product->category_id = $category->id;
        $product->save();
        //A este producto, le añadimos unas cuantas opiniones:
        $opinion = new Opinion();
        $opinion->titulo = 'Titulo de la opnion';
        $opinion->comentario = 'Comentario de la oipnion';
        $opinion->valor = '3';
        $opinion->product_id = $product->id;
        $opinion->save();

        $opinion = new Opinion();
        $opinion->titulo = 'Titulo  2  de la opnion';
        $opinion->comentario = 'Comentario 2   de la oipnion';
        $opinion->valor = '5';
        $opinion->product_id = $product->id;
        $opinion->save();

        $opinion = new Opinion();
        $opinion->titulo = 'Titulo  3  de la opnion';
        $opinion->comentario = 'Comentario 3   de la oipnion';
        $opinion->valor = '5';
        $opinion->product_id = $product->id;
        $opinion->save();

        $opinion = new Opinion();
        $opinion->titulo = 'Titulo  4  de la opnion';
        $opinion->comentario = 'Comentario 4   de la oipnion';
        $opinion->valor = '4';
        $opinion->product_id = $product->id;
        $opinion->save();

        $product = new Product();
        $product->producto = 'Test para opiniones';
        $product->descripcion = 'Si necesitas un equipo para tus tareas cotidianas t';
        $product->precio = '123';
        $product->category_id = $category->id;
        $product->save();
        //A este producto, le añadimos unas cuantas opiniones:
        $opinion = new Opinion();
        $opinion->titulo = 'Titulo 4 de la opnion';
        $opinion->comentario = 'Al contrario del pensamiento popular, el texto de Lorem Ipsum no es simplemente texto aleatorio. T';
        $opinion->valor = '3';
        $opinion->product_id = $product->id;
        $opinion->save();

        $opinion = new Opinion();
        $opinion->titulo = 'Titulo 3 de la opnion';
        $opinion->comentario = 'gresó como texto de relleno en documentos electrónicos, quedando esencialmente ig';
        $opinion->valor = '2';
        $opinion->product_id = $product->id;
        $opinion->save();

        //Pedimos 20 productos aleatorios  usuario:
        factory(Product::class, 20)->create();
    }
}
