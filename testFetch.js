const body = document.getElementsByTagName("body")[0];

async function fetchJSON(request) {
    try {
      const response = await fetch(request);
      const contentType = response.headers.get("content-type");
      if (!contentType || !contentType.includes("application/json")) {
        throw new TypeError("Oops, we haven't got JSON!");
      }
      const jsonData = await response.json();
      
      const p = document.createElement("p");
      p.innerHTML = JSON.stringify(jsonData, null, 2);
      body.appendChild(p);
    } catch (error) {
      console.error("Error:", error);
    }
}

fetchJSON("./php/datiHome.php");