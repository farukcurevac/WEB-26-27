const pageContent = document.querySelector("#page-content");
const pages = new Set(["page1.html", "page2.html"]);

async function loadPage() {
  const pageName = window.location.hash.slice(1);

  if (!pages.has(pageName)) {
    pageContent.innerHTML = "<p>Izaberite stranicu iz navigacije.</p>";
    return;
  }

  try {
    const response = await fetch(`views/${pageName}`);

    if (!response.ok) {
      throw new Error(`Stranica nije pronađena: ${pageName}`);
    }

    pageContent.innerHTML = await response.text();
  } catch (error) {
    pageContent.innerHTML = "<p>Greška pri učitavanju stranice.</p>";
    console.error(error);
  }
}

window.addEventListener("hashchange", loadPage);
loadPage();