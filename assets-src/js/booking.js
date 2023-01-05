//show green border on selected card
function borderCardRadio() {
  var cardsRadio = document.querySelectorAll(".radio-card");
  var inputsRadio = document.querySelectorAll(".radio-input");

  inputsRadio.forEach(function (inputRadio, indexInput) {
    inputRadio.addEventListener("change", function () {
      cardsRadio.forEach(function (cardRadio, indexCard) {
        if (indexInput == indexCard)
          cardRadio.classList.add("has-border-green");
        else cardRadio.classList.remove("has-border-green");
      });
    });
  });
}

/* Steps Page - Next and Back button */
var content = document.querySelector(".section-wrapper");
var currentStep = 1;
var navscroll = document.querySelector(
  '[data-index="'.concat(currentStep, '"]')
);
var progressBar = document.querySelector(
  '[data-progress="'.concat(currentStep, '"]')
);
// need to define btns globally
var btnNext = content.querySelector(".btn-next-step");
var btnBack = content.querySelector(".btn-back-step");

function pageSteps() {
  if (!content) return;
  var btnSave = content.querySelectorAll(".saveBtn");
  navscroll.classList.add("d-lg-block");
  progressBar.classList.remove("d-none");
  btnSave.forEach(function (element) {
    element.classList.add("invisible");
  });

  if (btnNext) {
    btnNext.addEventListener("click", function () {
      openNext();
    });
  }

  if (btnBack) {
    btnBack.addEventListener("click", function () {
      backPrevious();
    });
  }
}

function openNext() {
  btnBack.disabled = false;
  var btnSave = content.querySelectorAll(".saveBtn");
  var steps = content.querySelectorAll("[data-steps]");
  var nextStep = content.querySelector(
    '[data-steps="'.concat(currentStep + 1, '"]')
  );
  var stepWrapper = content.querySelector("[data-steps].active");
  navscroll.classList.remove("d-lg-block");
  progressBar.classList.remove("d-block");
  progressBar.classList.add("d-none");

  if (currentStep == steps.length) {
    confirmAppointment();
    return;
  } else {
    stepWrapper.classList.add("d-none");
    stepWrapper.classList.remove("active");
    nextStep.classList.add("active");
    nextStep.classList.remove("d-none");
    currentStep = currentStep + 1;
    checkMandatoryFields();
    progressBar = document.querySelector(
      '[data-progress="'.concat(currentStep, '"]')
    );
    progressBar.classList.add("d-block");
    progressBar.classList.remove("d-none");

    if (currentStep < steps.length) {
      navscroll = document.querySelector(
        '[data-index="'.concat(currentStep, '"]')
      );
      navscroll.classList.add("d-lg-block");
    }

    if (currentStep == steps.length) {
      content.classList.remove("offset-lg-1");
    }

    if (currentStep == steps.length) {
      btnNext.disabled = false;
      content.querySelector(".steppers-btn-confirm span").innerHTML = "Invia";
      btnSave.forEach(function (element) {
        element.classList.remove("invisible");
        element.classList.add("visible");
        setReviews();
      });
    }
  }
}

function backPrevious() {
  btnNext.disabled = false;
  var btnSave = content.querySelectorAll(".saveBtn");
  var steps = content.querySelectorAll("[data-steps]");
  var stepWrapper = content.querySelector("[data-steps].active");
  var previousStep = content.querySelector(
    '[data-steps="'.concat(currentStep - 1, '"]')
  );

  if (currentStep == 1) {
    return;
  } else {
    previousStep.classList.remove("d-none");
    previousStep.classList.add("active");
    stepWrapper.classList.add("d-none");
    stepWrapper.classList.remove("active");
    navscroll.classList.remove("d-lg-block");
    progressBar.classList.add("d-none");
    currentStep = currentStep - 1;
    progressBar = document.querySelector(
      '[data-progress="'.concat(currentStep, '"]')
    );
    progressBar.classList.toggle("d-none");
    content.querySelector(".steppers-btn-confirm span").innerHTML = "Avanti";

    if (currentStep < steps.length) {
      navscroll = document.querySelector(
        '[data-index="'.concat(currentStep, '"]')
      );
      navscroll.classList.add("d-lg-block");
      content.classList.add("offset-lg-1");
    }

    if (currentStep < steps.length) {
      btnSave.forEach(function (element) {
        element.classList.remove("visible");
        element.classList.add("invisible");
      });
    }

    if (currentStep == 1) {
      btnBack.disabled = true;
    }
  }
}

pageSteps();

/* Define an empty object to collect answers */
const answers = {};

const encodeObject = (obj) => encodeURIComponent(JSON.stringify(obj));
const decodeObj = (str) => JSON.parse(decodeURIComponent(str));

const saveAnswerByValue = (key, value, toBeDecoded = false) => {
  if (key == "office") for (k in answers) delete answers[k];
  if (toBeDecoded) {
    const newValue = decodeObj(value);
    answers[key] = newValue;
  } else answers[key] = value;
  checkMandatoryFields();
};
const saveAnswerById = (key, id, callback) => {
  const value = document.getElementById(id)?.value;
  answers[key] = JSON.parse(value);
  if (typeof callback == "function") callback();
  checkMandatoryFields();
};

/* Get Luoghi by Unità organizzativa - Step 1 */
const officeSelect = document.getElementById("office-choice");
officeSelect.addEventListener("change", () => {
  const id = officeSelect?.value;
  const name = officeSelect?.querySelector(`[value="${id}"]`)?.innerText;
  saveAnswerByValue("office", encodeObject({ id, name }), true);

  if (officeSelect?.value) {
    const urlParam = new URLSearchParams({ id: officeSelect.value });
    fetch(`${window.wpRestApi}wp/v2/sedi/ufficio/?${urlParam}`)
      .then((response) => response.json())
      .then((data) => {
        document.querySelector("#place-cards-wrapper").innerHTML =
          '<legend class="visually-hidden">Seleziona un ufficio</legend>';
        for (const place of data) {
          const reducedPlace = {
            nome: place.post_title,
            indirizzo: place.indirizzo,
            apertura: place.apertura,
            id: place.identificativo,
          };
          document.querySelector("#place-cards-wrapper").innerHTML += `
          <div class="cmp-info-radio radio-card">
            <div class="card p-3 p-lg-4">
              <div class="card-header mb-0 p-0">
                <div class="form-check m-0">
                    <input
                    class="radio-input"
                    name="beneficiaries"
                    type="radio"
                    id=${place?.ID}
                    value='${JSON.stringify(reducedPlace)}'
                    onclick="saveAnswerById('place', ${place?.ID}, ${() =>
            setSelectedPlace()})"
                    />
                    <label for=${place?.ID}>
                    <h3 class="big-title mb-0 pb-0">
                        ${place?.post_title}
                    </h3></label
                    >
                </div>
              </div>
              <div class="card-body p-0">
                <div class="info-wrapper">
                  <span class="info-wrapper__label">Indirizzo</span>
                  <p class="info-wrapper__value">
                  ${place?.indirizzo}
                  </p>
                </div>
                <div class="info-wrapper">
                    <span class="info-wrapper__label">Apertura</span>
                    <p class="info-wrapper__value">
                    ${place?.apertura}
                    </p>
                </div>
              </div>
            </div>
          </div>
          `;
        }
        borderCardRadio();
      })
      .catch((err) => {
        console.log("err", err);
      });

    /* Get Servizi by Unità organizzativa - Step 3 */
    fetch(`${window.wpRestApi}wp/v2/servizi/ufficio?${urlParam}`)
      .then((response) => response.json())
      .then((data) => {
        document.querySelector("#motivo-appuntamento").innerHTML =
          '<option selected="selected" value="">Seleziona opzione</option>';
        for (const service of data) {
          document.querySelector("#motivo-appuntamento").innerHTML += `
          <option value="${service?.ID}">${service?.post_title}</option>
          `;
        }
      })
      .catch((err) => {
        console.log("err", err);
      });
  } else {
    document.querySelector("#place-cards-wrapper").innerHTML = "";
  }
});

/* Step 2 */
/* Get appointments calendar */
const appointment = document.getElementById("appointment");
appointment.addEventListener("change", () => {
  answers.appointment = null;
  checkMandatoryFields();

  // modificare l'url se si vuole integrare con un servizio esterno
  fetch(url + `?month=${appointment?.value}&office=${answers?.place?.id}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("HTTP error " + response.status);
      }
      return response.json();
    })
    .then((data) => {
      data = data[appointment?.value]
      document.querySelector("#radio-appointment").innerHTML =
        '<legend class="visually-hidden">Seleziona un giorno e orario</legend>';
      for (const dates of data) {
        const { startDate, endDate } = dates;
        const startDay = startDate.split("T")[0];
        const startDayStr = new Date(startDay).toLocaleString([], {
          weekday: "long",
          day: "2-digit",
          month: "long",
          year: "numeric",
        });
        const id = startDate + "/" + endDate;
        const value = encodeObject({ startDate, endDate });

        document.querySelector("#radio-appointment").innerHTML += `
        <div
        class="radio-body border-bottom border-light"
        >
        <input name="radio" type="radio" id="${id}" onclick="saveAnswerByValue('appointment', '${value}', true)"/>
        <label for="${id}" class="text-capitalize">${startDayStr} ore ${
          startDate.split("T")[1]
        }</label>
        </div>
        `;
      }
    })
    .catch((err) => {
      console.log("err", err);
    });
});

/* Get selected office */
const setSelectedPlace = () => {
  const place = answers?.place;
  document.querySelector("#selected-place-card").innerHTML = `  
  <div class="cmp-info-summary bg-white mb-4 mb-lg-30 p-4">
  <div class="card">
      <div
      class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end"
      >
      <h3 class="title-large-semi-bold mb-3">
        ${place?.nome}
      </h3>
      </div>

      <div class="card-body p-0">
      <div class="single-line-info border-light">
          <div class="text-paragraph-small">Indirizzo</div>
          <div class="border-light">
          <p class="data-text">
            ${place?.indirizzo}
          </p>
          </div>
      </div>
      <div class="single-line-info border-light">
          <div class="text-paragraph-small">Apertura</div>
          <div class="border-light">
          <p class="data-text">
            ${place?.apertura}
          </p>
          </div>
      </div>
      </div>
      <div class="card-footer p-0"></div>
  </div>
  </div>
</div>
  `;
};

/* Step 3 */
const serviceSelect = document.getElementById("motivo-appuntamento");
serviceSelect.addEventListener("change", () => {
  const id = serviceSelect?.value;
  const name = serviceSelect?.querySelector(`[value="${id}"]`)?.innerText;
  saveAnswerByValue("service", encodeObject({ id, name }), true);
});

const moreDetailsText = document.getElementById("form-details");
moreDetailsText.addEventListener("input", () => {
  saveAnswerByValue("moreDetails", moreDetailsText?.value);
});

/* Step 4 */
const nameInput = document.getElementById("name");
nameInput.addEventListener("input", () => {
  saveAnswerByValue("name", nameInput?.value);
});

const surnameInput = document.getElementById("surname");
surnameInput.addEventListener("input", () => {
  saveAnswerByValue("surname", surnameInput?.value);
});

const emailInput = document.getElementById("email");
emailInput.addEventListener("input", () => {
  saveAnswerByValue("email", emailInput?.value);
});

/* Step 5 */
const getDay = () => {
  const day = answers?.appointment?.startDate?.split("T")[0];
  return new Date(day).toLocaleString([], {
    weekday: "long",
    day: "2-digit",
    month: "long",
    year: "numeric",
  });
};

const getHour = () => {
  const dates = answers?.appointment;
  return [dates?.startDate?.split("T")[1], dates?.endDate?.split("T")[1]];
};

const setReviews = () => {
  //set all values
  document.getElementById("review-office").innerHTML = answers?.office?.name;
  document.getElementById("review-place").innerHTML = answers?.place?.nome;
  document.getElementById("review-date").innerHTML = getDay();
  document.getElementById("review-hour").innerHTML = `${getHour()[0]} - ${
    getHour()[1]
  }`;
  document.getElementById("review-service").innerHTML = answers?.service?.name;
  document.getElementById("review-details").innerHTML = answers?.moreDetails;
  document.getElementById("review-name").innerHTML = answers?.name;
  document.getElementById("review-surname").innerHTML = answers?.surname;
  document.getElementById("review-email").innerHTML = answers?.email;
};

/* Check mandatory fields */
const checkMandatoryFields = () => {
  switch (currentStep) {
    case 1:
      if (answers?.office && answers?.place) btnNext.disabled = false;
      else btnNext.disabled = true;
      break;

    case 2:
      if (answers?.appointment) btnNext.disabled = false;
      else btnNext.disabled = true;
      break;

    case 3:
      if (answers?.service && answers?.moreDetails) btnNext.disabled = false;
      else btnNext.disabled = true;
      break;

    case 4:
      if (answers?.name && answers?.surname && answers?.email)
        btnNext.disabled = false;
      else btnNext.disabled = true;
      break;

    default:
      break;
  }
};

/* confirm appointment - Submit */

async function successFeedback() {
  document.getElementById("email-recap").innerText = answers?.email;
  document.getElementById("date-recap").innerText = ` ${getDay()} dalle ore ${
    getHour()[0]
  } alle ore ${getHour()[1]}`;
  //service
  const service = await getServiceDetail(answers?.service?.id);
  if (service?._dci_servizio_cosa_serve_list?.length > 0 || service?._dci_servizio_cosa_serve_introduzione) {
    const neededBox = document.getElementById("needed-recap");
    neededBox.innerHTML = `
      <p class="font-serif">${service?._dci_servizio_cosa_serve_introduzione}</p>
    `;
    if (service?._dci_servizio_cosa_serve_list?.length > 0) {
      neededBox.innerHTML += "<ul>";
      service._dci_servizio_cosa_serve_list.forEach((item) => {
        neededBox.innerHTML += `<li>${item}</li>`;
      });
      neededBox.innerHTML += "</ul>";
    }
  }
  //office
  document.getElementById("office-recap").innerHTML = `
    <a
      href="#"
      class="text-decoration-none"
      >${answers?.office?.name}</a
    >  
  `;
  document.getElementById("address-recap").innerHTML = answers?.place?.nome;

  // show final step
  document.getElementById("form-steps").classList.add("d-none");
  document.getElementById("final-step").classList.remove("d-none");
}

const confirmAppointment = () => {
  const body = new URLSearchParams();

  for (var key in answers) {
    if (typeof answers[key] == "object") {
      body.append(key, JSON.stringify(answers[key]));
    } else body.append(key, answers[key]);
  }
  body.append("action", "save_appuntamento");

  // modificare l'url se si vuole integrare con un servizio esterno
  fetch(urlConfirm, {
    method: "POST",
    credentials: "same-origin",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      "Cache-Control": "no-cache",
    },
    body,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("HTTP error " + response.status);
      }
      return response.json();
    })
    .then((data) => {
      /* show success message */
      successFeedback();
      /* scroll to top of page */
      const mainContainer = document.querySelector("#main-container");
      if (mainContainer) mainContainer.scrollIntoView({ behavior: "smooth" });
    })
    .catch((err) => {
      console.log("err", err);
    });
};

async function getServiceDetail(id) {
  try {
    const res = await fetch(`${window.wpRestApi}wp/v2/servizi/${id}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("HTTP error " + response.status);
        }
        return response.json();
      })
      .then((data) => {
        return data?.cmb2?._dci_servizio_box_cosa_serve;
      })
      .catch((err) => {
        console.log("err", err);
      });

    return res;
  } catch (e) {
    console.error(e);
  }
}
