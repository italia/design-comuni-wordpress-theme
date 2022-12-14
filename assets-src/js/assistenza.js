(function () {
    const $wrapper = document.querySelector(".container-assistenza");
  
    /* the API returns an array with the services names or an empty array, but eventual errors aren't blocking */
    async function getServices(categoria) {
      try {
        const res = await fetch(
          `${window.wpRestApi}wp/v2/servizi${
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
        const privacyChecked = $wrapper.querySelector("#privacy").checked;
  
        const node = {
          title: `ticket_${new Date().toISOString()}`,
          nome,
          cognome,
          email,
          categoria_servizio,
          servizio,
          dettagli,
          privacyChecked,
        };
  
        // check invalid values
        const EMAIL_REGEXP =
          /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const emptyFields = Object.values(node)?.filter((v) => !v);
        if (emptyFields?.length > 0 || !EMAIL_REGEXP.test(email)) return false;
  
        // modificare l'url se si vuole integrare con un servizio esterno
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
  
    function successFeedback() {
      document.getElementById("first-step").classList.add("d-none");
      document.getElementById("email-recap").innerText =
        $wrapper.querySelector('[name="email"]').value;
      document.getElementById("second-step").classList.remove("d-none");
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
          /* show success message */
          successFeedback();
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
  