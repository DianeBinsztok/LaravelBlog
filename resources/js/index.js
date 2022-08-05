import './bootstrap';

console.log("Je suis làààà !!!!");

const src = "/api/posts/";

let html = '';

function handlePostData(postData) {
    const post = {
        id: postData.id,
        title: postData.title,
        date: postData.date,
        content: postData.content,
        user_id: postData.user_id,
    };
    return post;
}

function fetchData() {
    // fetch().then() peut aussi s'écrire avec asynch().await()
    fetch(src)
        .then((response) => {
            // renvoie une promesse: pas encore un résultat
            if (!response.ok) {
                throw new Error(
                    `Erreur ${response.status}: La requête à l' API a échoué.`
                );
            } else {
                console.log(response.json());
                return response.json();
            }
        })
        .then(
            // récupère le retour du .then() précédent: doit être un .json()
        )
        .catch(function handleError(error) {
            let failMsg = document.createElement("h3");
            failMsg.innerText = `La requête s'est soldée par un échec : ${JSON.stringify(
                error
            )}`;
        });
}

fetchData();
