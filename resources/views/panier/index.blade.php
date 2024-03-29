<h2>Mon panier</h2>
<a href="{{ route('product.index') }}">Voir tous les produits</a>
@foreach ($panier as $produit_id => $produit)
    <tr>
        <td>Nom : {{ $produit['name'] }}</td>
        <td>Prix : {{ $produit['price'] * $produit['quantite']}}$</td>
        <td>Quantité : {{ $produit['quantite'] }}</td>
        <td>
            <form action="{{ route('panier.quantitée', $produit_id) }}" method="PUT">
            @csrf
            {{-- @method('PUT') --}}
            <input type="number" name="quantite" value="{{ $produit['quantite'] }}" min="1">
            <button type="submit">Mettre à jour</button>
            </form>
        </td>
        {{-- @if(auth()->user()->type == '0') --}}
            <a href="{{ route('panier.supprimer', $produit_id) }}">Supprimer</a>
            <a href="{{ route ('panier.valider') }}">Valider</a>
            {{-- <a href="{{ route('panier.valider', $produit_id) }}">Valider</a> --}}
        {{-- @endif --}}

    </tr>
@endforeach


