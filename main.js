const { ref, createApp } = Vue;

const nav = ref([
    {
        name: '控制',
        img: 'control.png',
    },
    {
        name: '護送',
        img: 'online.png',
    },
    {
        name: '鬥陣對決',
        img: 'crosshair.png',
    },
    {
        name: '團隊死鬥',
        img: 'group.png',
    },
])

const sliders = ref([
    {
        title: '控制',
        text: '雙方隊伍在戰鬥中爭奪機器人的控制權，並將其推進至對手的基地。',
        img: 'slider1.jpg',
    },
    {
        title: '護送',
        text: '一支隊伍護送目標至目的地，另一支隊伍嘗試在目標抵達終點前阻止對方。',
        img: 'slider2.jpg',
    },
    {
        title: '鬥陣對決',
        text: '殺死所有敵人以獲得回合勝利。贏得三回合即可獲勝。一人、三人或六人的隊伍都可以參加。',
        img: 'slider3.jpg',
    },
    {
        title: '團隊死鬥',
        text: '組成隊伍、戰勝敵人，取得最高擊殺數的隊伍即可獲勝。',
        img: 'slider4.jpg',
    },
])

const app = createApp({
    setup() {
        const current_slider = ref(0)
        const container_bg = ref('./img/slider1.jpg')

        const sliderArrow = n => {
            current_slider.value = (current_slider.value + n + 4) % 4
            container_bg.value = `img/slider${current_slider.value + 1}.jpg`
        }

        const setSliderIndex = n => {
            current_slider.value = n
            container_bg.value = `img/slider${n + 1}.jpg`
        }

        return {
            container_bg,
            current_slider,
            nav,
            sliders,
            sliderArrow,
            setSliderIndex
        };
    }
});

app.mount('#app');
