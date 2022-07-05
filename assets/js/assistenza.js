(function () {
  const $wrapper = document.querySelector(".container-assistenza");

  /* the API returns an array with the services names or an empty array, but eventual errors aren't blocking */
  async function getServices(categoria) {
    try {
      const res = await fetch(
        `/wp-json/wp/v2/servizi${
          !!categoria ? `?categorie_servizio=${categoria}` : ""
        }`
      );
      const servizi = await res.json();
      return servizi;
    } catch (e) {
      console.error(e);
    }
  }

  async function postNode() {
    try {
      // NOTE: form validation at the html level
      const nome = $wrapper.querySelector('[name="name"]').value;
      const cognome = $wrapper.querySelector('[name="surname"]').value;
      const email = $wrapper.querySelector('[name="email"]').value;
      const categoria_servizio = $wrapper.querySelector("#category").value;
      const servizio = $wrapper.querySelector("#service").value;
      const dettagli = $wrapper.querySelector("#description").value;

      const node = {
        title: `ticket_${new Date().toISOString()}`,
        nome,
        cognome,
        email,
        categoria_servizio,
        servizio,
        dettagli,
      };

      const res = await fetch(data_assistenza.url, {
        method: "POST",
        credentials: "same-origin",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Cache-Control": "no-cache",
        },
        body: new URLSearchParams({
          action: "save_richiesta_assistenza",
          ...node,
        }),
      });

      return res.ok;
    } catch (e) {
      console.error(e);
    }
  }

  function resetServizio(select_servizio) {
    const firstSelectChild = select_servizio.firstElementChild;
    select_servizio.innerHTML = "";
    select_servizio.append(firstSelectChild);
    select_servizio.disabled = true;
  }

  function createSuccessFeedback() {
    const feedbackHeading = document.createElement("h2");
    feedbackHeading.classList.add("title-xxlarge", "mb-0");
    feedbackHeading.innerText = "Richiesta inviata correttamente";
    const feedbackDetails = document.createElement("p");
    feedbackDetails.classList.add("text-paragraph", "mb-3");
    feedbackDetails.innerText = "Riceverai risposta entro breve.";
    const feedback = document.createElement("div");
    feedback.append(feedbackHeading, feedbackDetails);
    return feedback;
  }

  function createFailureFeedback() {
    const feedbackDetails = document.createElement("p");
    feedbackDetails.classList.add(
      "form-feedback",
      "just-validate-error-label",
      "ms-0"
    );
    feedbackDetails.innerText = "something went wrong, try again";
    const feedback = document.createElement("div");
    feedback.classList.add("errorFeedback");
    feedback.appendChild(feedbackDetails);
    return feedback;
  }

  async function assistenza() {
    const form = $wrapper.querySelector(".steppers-content");
    if (!form) return;

    const select_category = form.querySelector("#category");
    if (!select_category) return;

    const select_servizio = form.querySelector("#service");
    if (!select_servizio) return;

    select_category.addEventListener("change", async (event) => {
      resetServizio(select_servizio);

      const categoria = event.target.value;
      if (!categoria) return;

      const servizi = await getServices(categoria);
      if (!Array.isArray(servizi)) return;

      for (servizio of servizi) {
        const title = servizio?.title?.rendered;
        const option = document.createElement("option");
        option.value = title;
        option.text = title;
        select_servizio.add(option);
      }

      if (select_servizio.childElementCount > 1)
        select_servizio.disabled = false;
    });

    form.addEventListener("submit", async () => {
      /* clear error message */
      const errorFeedback = form.querySelector(".errorFeedback");
      if (errorFeedback) errorFeedback.remove();
      /* API call */
      const success = await postNode();
      if (success) {
        /* replace form with success message */
        const successFeedback = createSuccessFeedback();
        form.innerHTML = "";
        form.appendChild(successFeedback);
        /* scroll to top of page */
        const navbar = document.querySelector(".menu-wrapper");
        if (navbar) navbar.scrollIntoView({ behavior: "smooth" });
      } else {
        /* append failure message */
        const failureFeedback = createFailureFeedback();
        const privacyWrapper = form.querySelector(".privacy-wrapper");
        if (!privacyWrapper) return;
        form.insertBefore(failureFeedback, privacyWrapper);
      }
    });
  }

  if ($wrapper) assistenza();
})();
