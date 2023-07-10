const style = `
#preview-image {
    position: absolute;
    inset: 0;
    display: none;
    align-items: center;
    justify-content: space-between;
    z-index: 998;


    & .bg {
        position: absolute;
        inset: 0;
        background: #0009;
    }

    & img {
        z-index: 999;
    }

    & button {
        z-index: 999;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 1px solid #ccc;
    }
}
`

const styleTag = document.createElement('style')
styleTag.innerHTML = style
document.head.appendChild(styleTag)


const imgs = document.querySelectorAll('img');


const previewDiv = document.createElement('div')
previewDiv.id = 'preview-image'
previewDiv.innerHTML = `
<div class="bg"></div>
<button class="left">&lt;</button>
<img src="" alt="">
<button class="right">&gt;</button>`
document.body.appendChild(previewDiv)

const preview = document.querySelector('#preview-image')
const srcAry = [];
const currentImg = document.querySelector('#preview-image > img')
let currentImgIdx = 0

imgs.forEach((img, index) => {
    srcAry.push(img.src)
    img.addEventListener('click', () => {
        currentImgIdx = index
        preview.style.display = 'flex'
        currentImg.src = srcAry[currentImgIdx]
    })
})

const len = srcAry.length - 1;

console.log(len);
document.querySelector('#preview-image > .bg').addEventListener('click', (e) => {
    preview.style.display = 'none';
})
document.querySelector('#preview-image > .left').addEventListener('click', (e) => {
    currentImgIdx = currentImgIdx === 0 ? len : currentImgIdx - 1;
    currentImg.src = srcAry[currentImgIdx]
})
document.querySelector('#preview-image > .right').addEventListener('click', (e) => {
    currentImgIdx = currentImgIdx === len ? 0 : currentImgIdx + 1;
    currentImg.src = srcAry[currentImgIdx]
})