<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Opinion;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Método que permite acceder a las rutas solo si estás logeado.
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('private.home');
    }

    //Para la zona privada
    public function listarProductos()
    {
        //Cargar listado de productos de la bbdd:
        //Quiero todos los productos con paginación de 5 por página.
        $productos = Product::paginate(5);
        //$productos = Product::where('id', '>', 0)->paginate(15);
        // Pedir los productos con condiciones
        //$productos = Product::where('precio', '>=', '500')->get();
        //TODO: Añadir en el seed 10 productos a boleo (factories), y metemos paginación
        $categories = Category::all();
        //Mostrar en pantalla la variable $productos a ver si tiene los datos:
        //dd($productos);

        return view('private.listado')
            ->with('prs', $productos)
            ->with('cat', $categories);
    }

    //Para la zona publica
    public function listarProductosPublic()
    {
        $productos = Product::paginate(5);

        return view('public.index')
            ->with('prs', $productos);
    }

    public function addProduct(Request $request)
    {
        $prod = new Product();
        $prod->producto = $request->producto;
        $prod->descripcion = $request->descripcion;
        $prod->precio = $request->precio;
        $prod->category_id = $request->category_id;

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->getClientOriginalExtension();

        $request->image->move(public_path('img_uploads'), $imageName);
        $prod->image = $imageName;
        $prod->save();

        //Es mejor cuando se hace un insert, no redirigir a la funcion directamente, sino vuelve a insertar si refrescamos la página
        //return $this->listarProductos();

        //Lo mejor es redirigir a la ruta que se encarga de listar:
        return redirect()->route('productos.listar');
    }

    public function delProduct($id)
    {
        $prod = Product::find($id);
        $prod->delete();

        return redirect()->route('productos.listar');
    }

    public function getProduct($id)
    {
        $producto = Product::find($id);

        return view('private.update')
         ->with('prs', $producto);
    }

    public function updateProduct(Request $request, $id)
    {
        $prod = Product::find($id);
        $prod->producto = $request->producto;
        $prod->descripcion = $request->descripcion;
        $prod->precio = $request->precio;
        $prod->image = $request->image;
        $prod->update();

        return redirect()->route('productos.listar');
    }

    public function getOpinions($product_id)
    {
        $opin_product = Opinion::where('product_id', '=', $product_id)->get();
        //dd($opin_product);

        return view('private.opinions_product')
        ->with('op_product', $opin_product);
    }

    public function getOpinions_v2($product_id)
    {
        $product = Product::find($product_id);

        return view('private.opinions_product_v2')
        ->with('product', $product);
    }

    public function setOpinion_public(Request $request)
    {
        $product_id = $request->id_prod;
        //dd($request);
        $opinion = new Opinion();
        $opinion->titulo = $request->titulo;
        $opinion->comentario = $request->messagetext;
        $opinion->valor = $request->valor;
        $opinion->product_id = $product_id;
        $opinion->save();

        return redirect('/');

        //return redirect()->route('public.index');
    }
}
