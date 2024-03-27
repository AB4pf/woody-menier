<x-app-layout>
    <style>
        .pannierImg{
            width: 70px;
            height: 50px;
        }
        .article{
            padding-bottom: 40px;
        }
    </style>
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
        <a href="{{ route('panier.index') }}"><img class="pannierImg" src="image/pannier.png" alt="pannier"></a>
        <div class="bandeau">
{{--            afficher les produits qui se trouve dans chaque categories en cliquant dessus--}}
            <div class="ctg">
                <p> Carégories :
                    @foreach($categories as $categories)
                    <a href="{{ route('category.index', $categories->slug) }}">{{ $categories->name }}</a>
                    @endforeach
                </p>
            </div>
            <div class="ppc">
                <p>Les paiements disponible : Paypal et Cheque</p>
            </div>
        </div>
    </header>
        <section class="all_section">
            <div class="all_article">
                @foreach($products as $product)
                    <div class="article">
                        <a href="{{ route('product.show', $product->id) }}"><img class="img" src="{{ asset('image/' . $product->image) }}" alt="{{ $product->title }} Image"></a><br>
                        <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                        <p>{{ $product->price }}</p>
                        <a href="{{ route('panier.ajouter', $product->id) }}"> @lang('Ajouter')</a>
                    </div>
                @endforeach
            </div>
        </section>
</x-app-layout>
