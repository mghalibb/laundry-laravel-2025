class CustomTag {
    init() {
        class AppMenu extends HTMLElement {
            connectedCallback() {
                this.outerHTML = `<div class="h-screen bg-white w-64 min-w-64 sticky top-0 z-40 transition-all border-e flex flex-col">
        <a href="index.html" class="shrink h-16 flex items-center justify-center border-b border-dashed border-gray-200">
          <div class="logo-dark flex items-center justify-center">
            <img src="assets/logo-dark.png" alt="Logo Cleanify" class="h-10 w-auto">
          </div>
        </a>
        <div class="grow overflow-y-auto">
          <ul class="flex flex-col gap-2 pt-2 menu">

            <li class="text-gray-600 text-xs uppercase font-bold px-6 py-2 mt-2">Overview</li>
            <li class="px-4">
              <a href="index.html" class="flex items-center gap-2.5 p-2.5 rounded-lg transition-all text-gray-600 hover:text-blue-600 hover:bg-blue-50 menu-link">
                <span class="shrink w-5">🏠</span>
                <span class="grow font-medium"> Pengantar (Intro) </span>
              </a>
            </li>
            <li class="px-4">
              <a href="installation.html" class="flex items-center gap-2.5 p-2.5 rounded-lg transition-all text-gray-600 hover:text-blue-600 hover:bg-blue-50 menu-link">
                <span class="shrink w-5">⚙️</span>
                <span class="grow font-medium"> Instalasi Teknis </span>
              </a>
            </li>

            <li class="text-gray-600 text-xs uppercase font-bold px-6 py-2 mt-2">Buku Panduan</li>
            <li class="px-4">
              <a href="guide.html" class="flex items-center gap-2.5 p-2.5 rounded-lg transition-all text-gray-600 hover:text-blue-600 hover:bg-blue-50 menu-link">
                <span class="shrink w-5">📖</span>
                <span class="grow font-medium"> User Manual </span>
              </a>
            </li>

            <li class="px-4">
              <a href="changelog.html" class="flex items-center gap-2.5 p-2.5 rounded-lg transition-all text-gray-600 hover:text-blue-600 hover:bg-blue-50 menu-link">
                <span class="shrink w-5">🔄</span>
                <span class="grow font-medium"> Changelog </span>
              </a>
            </li>
          </ul>
        </div>
        <div class="shrink text-center px-2 py-6 border-t border-gray-100">
          <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-blue-100 text-blue-600">v1.0 Stable</span>
        </div>
      </div>`;
            }
        }

        class AppFooter extends HTMLElement {
            connectedCallback() {
                this.outerHTML = `<footer class="h-16 flex items-center px-6 bg-white border-t border-gray-200 mt-auto">
        <div class="flex md:justify-between justify-center w-full gap-4">
          <div class="text-sm text-gray-500">
            ${new Date().getFullYear()} © Cleanify Laundry System - Developed by <strong>Ghalib</strong>
          </div>
        </div>
      </footer>`;
            }
        }

        function menuItemActive() {
            setTimeout(() => {
                const pageUrl = window.location.href.split(/[?#]/)[0];
                const pageName = pageUrl.substring(
                    pageUrl.lastIndexOf("/") + 1
                );
                document
                    .querySelectorAll("ul.menu a.menu-link")
                    .forEach((element) => {
                        if (element.getAttribute("href") === pageName) {
                            element.classList.add(
                                "active",
                                "bg-blue-50",
                                "text-blue-600"
                            );
                        }
                    });
            }, 100);
        }

        customElements.define("app-menu", AppMenu);
        customElements.define("app-footer", AppFooter);
        menuItemActive();
    }
}

new CustomTag().init();
