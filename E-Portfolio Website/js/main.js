const toggle = document.getElementById('menu-toggle');
const navmenu = document.getElementById('navmenu');

toggle.addEventListener('click', () => {
  navmenu.classList.toggle('active');
});

function showModal() {
  document.getElementById("popupModal").style.display = "flex";
  return false;
}

function closeModal() {
  document.getElementById("popupModal").style.display = "none";
  document.getElementById("contactForm").reset();
}

const sections = document.querySelectorAll("section[id]");
const navLinks = document.querySelectorAll(".navmenu a");

function activateLinkOnScroll() {
  let scrollY = window.pageYOffset;

  sections.forEach((section) => {
    const sectionHeight = section.offsetHeight;
    const sectionTop = section.offsetTop - 100;
    const sectionId = section.getAttribute("id");

    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
      navLinks.forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href") === `#${sectionId}`) {
          link.classList.add("active");
        }
      });
    }
  });
}
window.addEventListener("scroll", activateLinkOnScroll);

let slides = {
  destination: 0,
  tip: 0,
  exp: 0
};

const destinations = [
  {
    title: "Makkah Madinah",
    desc: "A spiritual journey to Makkah and Madinah. Perfect for those seeking peace, reflection, and religious fulfillment."
  },
  {
    title: "Turkey",
    desc: "From Hagia Sophia to Cappadocia – unforgettable! A beautiful mix of history, culture, and natural wonders."
  },
  {
    title: "Sydney",
    desc: "Beaches, kangaroos & the Opera House! A lively city with modern attractions and breathtaking coastal views."
  }
];

const tips = [
  {
    title: "Bring Your Passport",
    desc: "Keep your passport safe and carry it when heading to the airport. Consider using holder for extra protection."
  },
  {
    title: "Dress for the Weather",
    desc: "Bring clothes suitable for the climate and season of your destination. Always check the forecast before packing!"
  },
  {
    title: "Eat on the Plane",
    desc: "Airline meals are included – make sure you enjoy what's available! It saves time and keeps your energy up."
  }
];

const experiences = [
  {
    title: "Tasting Camel Rice",
    desc: "Enjoyed a unique cultural dish during our local experience – flavorful and memorable! A must-try for food lovers."
  },
  {
    title: "Sunrise Jeep Safari",
    desc: "Woke up at 4 AM for a thrilling ride to catch the hot air balloons in Cappadocia. The view was absolutely magical!"
  },
  {
    title: "Riding Gojek",
    desc: "Convenient and fun way to explore the city with local motorbike transport. Fast, easy, and affordable!"
  },
  {
    title: "Beach Day",
    desc: "Relaxed at Bondi Beach and enjoyed the sea breeze. Perfect spot for swimming, sunbathing, or just unwinding."
  }
];

function changeSlide(section, step) {
  const items = document.querySelectorAll(`#${section}-carousel .carousel-img, #${section}-carousel .carousel-text`);
  items.forEach(item => item.classList.remove("active"));

  slides[section] += step;
  if (slides[section] >= items.length) slides[section] = 0;
  if (slides[section] < 0) slides[section] = items.length - 1;

  items[slides[section]].classList.add("active");

  if (section === "destination") {
    document.getElementById("destination-title").innerText = destinations[slides[section]].title;
    document.getElementById("destination-desc").innerText = destinations[slides[section]].desc;
  }

  if (section === "tip") {
    document.getElementById("tip-title").innerText = tips[slides[section]].title;
    document.getElementById("tip-desc").innerText = tips[slides[section]].desc;
  }

  if (section === "exp") {
    document.getElementById("exp-title").innerText = experiences[slides[section]].title;
    document.getElementById("exp-desc").innerText = experiences[slides[section]].desc;
  }
}

window.onscroll = function () {
  const btn = document.getElementById("scrollTopBtn");
  if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
    btn.style.display = "flex";
  } else {
    btn.style.display = "none";
  }
};

document.getElementById("scrollTopBtn").addEventListener("click", function (e) {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: "smooth" });
});

const showBtn = document.getElementById("showPollBtn");
const pollSection = document.getElementById("pollSection");
const closeBtn = document.getElementById("closePollBtn");

showBtn.addEventListener("click", () => {
  pollSection.style.display = "block";
  showBtn.style.display = "none";
});

closeBtn.addEventListener("click", () => {
  pollSection.style.display = "none";
  showBtn.style.display = "inline-block";
  document.getElementById("pollForm").reset();
  document.getElementById("pollResult").innerText = "";
});

document.getElementById("pollForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const choice = document.querySelector('input[name="poll"]:checked');
  const resultDiv = document.getElementById("pollResult");
  if (choice) {
    resultDiv.innerText = `You voted for: ${choice.value}`;
  } else {
    resultDiv.innerText = "Please select an option before voting.";
  }
});

const filterButtons = document.querySelectorAll('.filter-button');
const portfolioItems = document.querySelectorAll('.portfolio-item');

filterButtons.forEach(button => {
  button.addEventListener('click', () => {
    filterButtons.forEach(btn => btn.classList.remove('filter-active'));
    button.classList.add('filter-active');

    const filterValue = button.getAttribute('data-filter');

    portfolioItems.forEach(item => {
      if (filterValue === 'all' || item.classList.contains(filterValue)) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
  });
});

function openModal(id) {
  document.getElementById(id).style.display = 'block';
}

function closeModal(id) {
  document.getElementById(id).style.display = 'none';
}

window.onclick = function (event) {
  const modals = document.querySelectorAll('.modal');
  modals.forEach(modal => {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });
};