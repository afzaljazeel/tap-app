document.addEventListener("DOMContentLoaded", function () {
    const faqButtons = document.querySelectorAll(".faq-question");

    faqButtons.forEach(button => {
        button.addEventListener("click", function () {
            const faqItem = this.parentElement;
            faqItem.classList.toggle("active");
       });
});
});