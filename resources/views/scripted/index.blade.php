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
                    <h2>Tous les articles:</h2>
                    <div id="posts_container">
                        <!-- injecter les données ici -->
                    </div>
                </div>
            </div>
            <script type="text/javascript">


                const src = "/api/posts/";
                //const container = document.getElementById('posts_container');
                const container = document.querySelector('#posts_container');
                let html = '';

                function handlePostData(postData) {
                    const post = {
                        title: postData.title,
                        date: postData.updated_at,
                        author: postData.user.name,
                        content: postData.content,
                        nbOfComments: postData.comments_count
                    };
                    return post;
                }

                function fetchPostData() {
                    // fetch().then() peut aussi s'écrire avec asynch().await()
                    fetch(src)
                        .then((response) => {
                            console.log("1 - fetch: response =>", response);
                            // renvoie une promesse: pas encore un résultat
                            if (response.ok) {
                                console.log("2 - Réponse ok, je la reçois sous cette forme =>", response);
                                return response.json();
                            } else {
                                throw new Error(
                                    `Erreur ${response.status}: La requête à l' API a échoué.`
                                );
                            }
                        })
                        .then((posts) => {
                                console.log("3 - Je reçois les données en json =>: ", posts);
                                // récupère le retour du .then() précédent: doit être un .json()
                                for (let post of posts.data) {
                                    let postObject = handlePostData(post);
                                    let postString = `<div class="post_item"><h2 style="font-size: 2em; font-weight: bold; margin: 1em;">${postObject.title}</h2> <h3 style="font-size: 1.3em; font-weight: bold; margin: 0.7em;">Publié le ${postObject.date} par ${postObject.author}</h3><p>${postObject.content}</p><h4>${postObject.nbOfComments} commentaire(s)</h4></div>`;
                                    html += postString;
                                }
                                container.innerHTML = html;
                            }
                        )
                        .catch(function handleError(error) {
                            console.log("3bis - en cas d'erreur =>: ", error);
                            let failMsg = document.createElement("h3");
                            failMsg.innerText = `La requête s'est soldée par un échec : ${JSON.stringify(
                                error
                            )}`;
                        });
                }

                fetchPostData();
            </script>

</x-guest-layout>

