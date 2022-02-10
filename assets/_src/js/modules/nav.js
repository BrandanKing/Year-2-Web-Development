export const nav = Vue.component('navigation', {
    data() {
        return {
            moved: true,
            selected: 0
        };
    },
    methods: {
        // Handle the animation on mobile when nav slides in and out
        sidebarHandler() {
            var sideBar = document.getElementById("mobile-nav");
            sideBar.style.transform = "translateX(-260px)";
            if (this.$data.moved) {
                sideBar.style.transform = "translateX(0px)";
                this.$data.moved = false;
            } else {
                sideBar.style.transform = "translateX(-260px)";
                this.$data.moved = true;
            }
        },
        select(i) {
          this.selected = i;
        }
    },
});
