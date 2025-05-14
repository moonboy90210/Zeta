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

// document.addEventListener('scroll', function() {
//     const background = document.querySelector('.background');
//     const content = document.querySelector('.content');
//     const scrollPosition = window.scrollY;
//     const contentTop = content.offsetTop;

//     if (scrollPosition >= contentTop) {
//         background.style.position = 'fixed';
//         background.style.top = '0';
//     } else {
//         background.style.position = 'absolute';
//         background.style.top = '0';
//     }
// });

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
