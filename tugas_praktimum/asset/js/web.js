tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        primary: "#B45309",
        "dark-bg": "#1C1917",
        "dark-text": "#F3F4F6",
        "card-bg-dark": "#292524",
        "card-bg-light": "#FFFFFF",
      },
    },
  },
};

if (
  localStorage.theme === "dark" ||
  (!("theme" in localStorage) &&
    window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  document.documentElement.classList.add("dark");
} else {
  document.documentElement.classList.remove("dark");
}

function toggleProfileMenu() {
  document.getElementById("profile-dropdown").classList.toggle("hidden");
}

// --- NEW/FIXED DROPDOWN LOGIC ---

// 1. Header Search Region Dropdown
function toggleHeaderRegionDropdown() {
  document.getElementById("header-region-dropdown").classList.toggle("hidden");
}

// 2. Section Acara Teramai Region Dropdown
function toggleSectionRegionDropdown() {
  document.getElementById("section-region-dropdown").classList.toggle("hidden");
}

function selectRegion(region, target) {
  if (target === "header") {
    document.getElementById("header-region-text").innerText = region;
    document.getElementById("header-region-dropdown").classList.add("hidden");
    // Optional: Sync section region to header region on change
    document.getElementById("section-region-text").innerText = region;
    document.getElementById("section-region-dropdown").classList.add("hidden");
  } else if (target === "section") {
    document.getElementById("section-region-text").innerText = region;
    document.getElementById("section-region-dropdown").classList.add("hidden");
  }
  console.log(`Loading events for: ${region} from ${target}`);
}

function toggleDarkMode() {
  if (document.documentElement.classList.contains("dark")) {
    document.documentElement.classList.remove("dark");
    localStorage.theme = "light";
  } else {
    document.documentElement.classList.add("dark");
    localStorage.theme = "dark";
  }
}

function bukaTab(namaTab) {
  const tabTiket = document.getElementById("tab-tiket");
  const tabKeranjang = document.getElementById("tab-keranjang");
  const btnTiket = document.getElementById("btn-tiket");
  const btnKeranjang = document.getElementById("btn-keranjang");

  if (namaTab === "tiket") {
    tabTiket.classList.remove("hidden");
    tabKeranjang.classList.add("hidden");

    btnTiket.classList.add("bg-primary", "text-white");
    btnKeranjang.classList.remove("bg-primary", "text-white");
  } else {
    tabTiket.classList.add("hidden");
    tabKeranjang.classList.remove("hidden");

    btnKeranjang.classList.add("bg-primary", "text-white");
    btnTiket.classList.remove("bg-primary", "text-white");
  }
}
