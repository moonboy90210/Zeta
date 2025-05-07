// ----------NAVBAR responsive----------
let lastScrollTop = 0;

window.addEventListener("scroll", function () {
	const nav = document.querySelector("nav");
	let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

	if (currentScroll > lastScrollTop) {
		// Scrolling down
		nav.style.top = "-100px"; // Hide navbar (adjust based on your nav height)
	} else {
		// Scrolling up
		nav.style.top = "0";
	}
	lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Avoid negative scroll
});

// this is the code to change background and font-color on scroll down
window.addEventListener("scroll", function () {
	const nav = document.querySelector(".navbar");
	if (window.scrollY > 70) {
	  nav.classList.add("scrolled");
	} else {
	  nav.classList.remove("scrolled");
	}
  });
//   -----------------------------------------

const sections = document.querySelectorAll('.section'); 

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    } else {
      // Remove visible class when section scrolls out
      entry.target.classList.remove('visible');
    }
  });
}, {
  threshold: 0.1
});

sections.forEach(section => {
  observer.observe(section);
}); 


// ----------------------CONTACT FORM------------------------
fetch("http://localhost/zeta/contact.php", {
	method: "POST",
	body: formData
  });
  
document.getElementById("contactForm").addEventListener("submit", function (e) {
	e.preventDefault(); // Prevent default form submission
  
	const formData = new FormData(this);

	fetch("contact.php", {
		method: "POST",
		body: formData
	  })
	  .then(response => response.text())
	  .then(data => {
		const formMessage = document.getElementById("formMessage");
		formMessage.innerHTML = `<div class="alert alert-primary">Thank you for reaching out!</div>`;
		document.getElementById("contactForm").reset();
	  })
	  .catch(error => {
		const formMessage = document.getElementById("formMessage");
		formMessage.innerHTML = `<div class="alert alert-danger">An error occurred. Please try again later.</div>`;
		console.error("Error:", error);
	  });


});