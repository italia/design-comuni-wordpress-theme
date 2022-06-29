const params = {};

const handleOnClick = (queryParams) => {
  const urlParams = new URLSearchParams(queryParams);
  for (const [key, value] of urlParams) {
    if (key !== "post_count" || !params["post_count"]) params[key] = value;
  }

  fetch(data.ajaxurl, {
    method: "POST",
    credentials: "same-origin",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      "Cache-Control": "no-cache",
    },
    body: new URLSearchParams({
      action: "load_more",
      query: data.posts,
      page: data.current_page,
      ...params,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      document.querySelector("#load-more").innerHTML = data.response;
      params.post_count = data.post_count;
      if (data.all_results) {
        document.querySelector("#load-more-btn").classList.add("d-none");
        document.querySelector("#no-more-results").classList.remove("d-none");
      }
    })
    .catch((err) => {
      console.log("err", err);
    });
};
