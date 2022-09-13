const eventName = "feedback-submit";

const submitRating = () => {
  const ratingFeedback = document.querySelector("#rating-feedback");
  ratingFeedback.innerHTML = "";
  //get current url & title
  const urlPieces = [location.protocol, "//", location.host, location.pathname];
  const page = urlPieces.join("");
  let title = document.querySelector("title").innerText;
  if (title?.includes("Risultati della ricerca per"))
    title = "Risultati di ricerca";

  // get answers
  const star =
    document.querySelector('input[name="ratingA"]:checked')?.value || null;
  const radioCheck = star > 3
    ? document.querySelector('input[name="rating1"]:checked')
    : document.querySelector('input[name="rating2"]:checked');
  const radioBox = radioCheck ? radioCheck.parentElement : null;
  const radioResponse = radioBox?.querySelector("label")?.innerHTML || null;
  const freeText =
    document.querySelector("#formGroupExampleInputWithHelp")?.value || null;

  const payload = {
    title,
    star,
    radioResponse,
    freeText,
    page,
  };

  // modificare l'url se si vuole integrare con un servizio esterno
  fetch(data.ajaxurl, {
    method: "POST",
    credentials: "same-origin",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      "Cache-Control": "no-cache",
    },
    body: new URLSearchParams({
      action: "save_rating",
      ...payload,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        const err = new Error("");
        throw err;
      } else {
        ratingFeedback.innerHTML =
          "Grazie, il tuo parere ci aiuterà a migliorare il servizio!";
      }
    })
    .catch((err) => {
      ratingFeedback.innerHTML = "Ops, qualcosa è andato storto.";
    });
};

document.addEventListener(eventName, () => submitRating());
