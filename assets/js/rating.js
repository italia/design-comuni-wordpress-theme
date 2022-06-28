const eventName = "feedback-submit";

const submitRating = () => {
  const ratingFeedback = document.querySelector("#rating-feedback");
  ratingFeedback.innerHTML = "";
  //get current url & title
  const urlPieces = [location.protocol, "//", location.host, location.pathname];
  const page = urlPieces.join("");
  const title = document.querySelector("title").innerText;

  // get answers
  const star =
    document.querySelector('input[name="ratingA"]:checked')?.value || null;
  const radioBox = document.querySelector(
    'input[name="rating"]:checked'
  ).parentElement;
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
