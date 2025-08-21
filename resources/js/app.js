import './bootstrap';

window.onload = function (event) {
    const media = window.matchMedia("(prefers-reduced-motion: reduce)");

    let prefersReducedMotion = media.matches === true;

    media.addEventListener("change", (event) => {
        prefersReducedMotion = event.matches === true;
    });

    function initScoreCircle(scoreElement, prefersReducedMotion) {
        const score = Number.parseInt(scoreElement.dataset.score, 10) || 0;
        const circle = scoreElement.querySelector("svg circle");
        const number = scoreElement.querySelector(".score-number");

        // Score class mapping
        const getScoreClass = (score) => {
            if (score <= 49) return "gauge-score:score-fail";
            if (score >= 50 && score <= 89) return "gauge-score:score-average";
            return "gauge-score:score-pass";
        };

        // Reset classes
        scoreElement.classList.add(getScoreClass(score));

        //Respect User Preferences
        if (prefersReducedMotion) return;

        // Stroke animation
        const radius = parseFloat(circle.getAttribute("r"));
        const circumference = 2 * Math.PI * radius;
        const baseDuration = 1.5; // seconds for 100
        const scaledDuration = (score / 100) * baseDuration;

        circle.style.strokeDasharray = circumference;
        circle.style.strokeDashoffset = circumference;
        circle.style.transform = "rotate(-90deg)";
        circle.style.transformOrigin = "center";

        const offset = circumference * (1 - score / 100);

        setTimeout(() => {
            circle.style.transition = `stroke-dashoffset ${scaledDuration}s ease-out`;
            circle.style.transition = "stroke-dashoffset 1.2s ease-out";
            circle.style.strokeDashoffset = offset;
        }, 200);

        const easeOut = t => 1 - Math.pow(1 - t, 3); // cubic
        const duration = 1000;

        let start = null;
        const animateNumber = (ts) => {
            if (start === null) start = ts;

            const progress = Math.min((ts - start) / duration, 1);
            const eased = easeOut(progress);
            const value = Math.round(score * eased);

            number.textContent = String(value);

            if (progress >= 1) {
                number.textContent = String(score);
                scoreElement.classList.remove(
                    "gauge-score:score-fail",
                    "gauge-score:score-average",
                    "gauge-score:score-pass"
                );
                scoreElement.classList.add(getScoreClass(score));
                return;
            }

            requestAnimationFrame(animateNumber);
        };

// Start animation – only this line:
        requestAnimationFrame(animateNumber);
    }

    document
        .querySelectorAll(".audit-score")
        .forEach((element, i) => setTimeout(
            () => initScoreCircle(element, prefersReducedMotion), i * 75)
        );

    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    document.documentElement.classList.toggle(
        "dark",
        localStorage.theme === "dark" ||
        (!("theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches),
    );
    // Whenever the user explicitly chooses light mode
    localStorage.theme = "light";
    // Whenever the user explicitly chooses dark mode
    localStorage.theme = "dark";
    // Whenever the user explicitly chooses to respect the OS preference
    localStorage.removeItem("theme");
};
