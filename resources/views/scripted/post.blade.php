<x-guest-layout>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <h1>Bienvenue sur le blog</h1>
        </div>
        <nav style="display: flex; justify-content:space-around;">
            <a href="{{route('login')}}"
               style="text-decoration: underline;  padding: 0.5em; font-weight: bold; border: 1px solid black; background-color: white">
                Login </a>
            <a href="{{route('register')}}"
               style="text-decoration: underline;  padding: 0.5em; font-weight: bold; border: 1px solid black; background-color: white">Register</a>
        </nav>


        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
                    <h2>Titre de l'article:</h2>
                </div>
            </div>
            <script src="../../js/post.js"></script>
</x-guest-layout>



