<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-around">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <h2 href=""
                class="underline text-gray-900 dark:text-white">Ajouter un article</h2>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <h1>Modifier l'article</h1>

                <form action="{{route('updatePost', $post)}}" method="POST" class="form-example"
                      style="display: flex; flex-direction: column;">
                    @method('PUT')
                    @csrf
                    <input name="post_id" type="hidden" value="{{$post->id}}">
                    <label for="post_title">Titre : </label>
                    <input name="post_title" value="{{$post->title}}"
                           style="border: 1px solid black; font-weight: bold"
                           size="25"
                           placeholder="{{$post->title}}">
                    <label for="post_content">Contenu</label>
                    <textarea name="post_content" id="content" cols="60" rows="20">
                            {{$post->content}}
                        </textarea>

                    <!-- Supprimer - modifier un article-->
                    <input type="submit" value="Enregistrer la modification"
                           style="color: blue; text-decoration: underline">

                </form>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mt-2 text-sm">
                    {{$post->comments_count}} commentaire(s):
                    @foreach($post->comments as $comment)
                        <div class="mt-2 text-sm">
                            <h4>
                                @if ($comment->user)
                                    Par {{$comment->user->name}}, {{$comment->created_at}}
                                @else
                                    Par {{$comment->pseudo}}, {{$comment->created_at->diffForHumans()}}
                                @endif
                            </h4>
                            <textarea name="content" id="content" cols="60" rows="5">
                               {{$comment->content}}
                        </textarea>

                        </div>
                        <div style="display: flex; justify-content: space-around">
                            <!-- Supprimer - modifier un commentaire-->
                            <a href="{{route('editPost', $post)}}" style="color: blue"
                               class="underline text-gray-900 dark:text-white">Modifier le commentaire</a>
                            <a href="{{route('updatePost', $post)}}" style="color: red"
                               class="underline text-gray-900 dark:text-white">Supprimer le commentaire</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
