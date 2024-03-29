<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function index()
    {
        // Récupérez les données du panier depuis la session
        $panier = session()->get('panier', []);

        // // Calculez le total du panier
        // $total_panier = 0;

        // foreach ($panier as $produit) {
        //     $total_panier +=  $produit['quantite'] * $produit['price'];
        // }


        // Retournez la vue du panier avec les données
        return view('panier.index', compact('panier'));
    }


    public function ajouter(Request $request, $produit_id)
    {
        $produit = product::find($produit_id);

        if (!$produit) {
            return redirect()->route('produits.index')->with('error', 'Produit non trouvé.');
        }

        $panier = session()->get('panier', []);

        if (array_key_exists($produit_id, $panier)) {
            // Le produit existe déjà dans le panier, augmentez la quantité
            $panier[$produit_id]['quantite']++;
        } else {
            // Ajoutez le produit au panier
            $panier[$produit_id] = [
                'name' => $produit->name,
                'price' => $produit->price,
                'quantite' => 1,
            ];
        }

        session()->put('panier', $panier);

        return redirect()->route('panier.index');

    }
    public function supprimer($produit_id)
    {
        $panier = session()->get('panier', []);

        if (array_key_exists($produit_id, $panier)) {
            unset($panier[$produit_id]); // Supprimez le produit du panier
            session()->put('panier', $panier); // Mettez à jour la session
        }

        return redirect()->route('panier.index')->with('success', 'Produit supprimé du panier.');
    }

    public function quantitée(Request $request, $produit_id)
    {
        $panier = session()->get('panier', []);

        // Vérifie si le produit existe dans le panier
        if (array_key_exists($produit_id, $panier)) {
            $panier[$produit_id]['quantite'] = $request->quantite;
            session()->put('panier', $panier);
        }

        return redirect()->route('panier.index');
    }

    public function valider()
    {
        return view('panier.show');
    }
}
