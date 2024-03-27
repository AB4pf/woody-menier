<x-app-layout>
    <header>
        <div>
            {{ Auth::user()->name }}
        </div>
        <x-dropdown-link :href="route('profile.edit')">
            {{ __('Profile') }}
        </x-dropdown-link>
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                             onclick="event.preventDefault();
                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
        <a href="{{ route('product.index') }}">Accueille</a>
        <div class="bandeau">
            {{--            afficher les produits qui se trouve dans chaque categories en cliquant dessus--}}
{{--            <div class="ctg">--}}
{{--                <p> Carégories :--}}
{{--                    @foreach($categories as $categories)--}}
{{--                        <a href="{{ route('category.index', $categories->slug) }}">{{ $categories->name }}</a>--}}
{{--                    @endforeach--}}
{{--                </p>--}}
{{--            </div>--}}
            <div class="ppc">
                <p>Les paiements disponible : Paypal et Cheque</p>
            </div>
        </div>
    </header>
    <h2>Mon panier</h2>
    <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
            <div class="w-full">
                <div class="border-b border-gray-200 shadow pt-6">
                    <table>
                        <tbody class="bg-white">
                        @foreach ($panier as $produit_id => $produit)
                            <tr>
                                <td>{{ $produit['name'] }}</td>
                                <td>${{ $produit['price'] }}</td>
                                <td>{{ $produit['quantite'] }}</td>
                                <td>${{ $produit['quantite'] * $produit['price'] }}</td>
                                <x-link-button href="{{ route('panier.supprimer', $produit_id) }}">
                                    @lang('Supprimer')
                                </x-link-button>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>
