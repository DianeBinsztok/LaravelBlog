<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-around">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1>Nouvel article</h1>
                <form action="{{route('storePost')}}" method="post" class="form-example"
                      class="p-6 bg-white border-b border-gray-200"
                      style="display: flex; flex-direction: column;">
                    @csrf
                    <label for="post_title">Titre : </label>
                    <input name="post_title"
                           style="border: 1px solid black; font-weight: bold"
                           size="25">
                    <label for="content">Contenu</label>
                    <textarea name="post_content" id="content" cols="60" rows="20">
                        </textarea>
                    <div style="display: flex; justify-content: space-around">
                        <!-- Supprimer - modifier un article-->
                        <input type="submit" value="Enregistrer l'article"
                               style="color: blue; text-decoration: underline">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
