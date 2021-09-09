// to move between small nav


let changing = document.querySelectorAll('.openingDiv')
let handle = document.querySelectorAll('.eachSmall')

changing = Array.from(changing)
handle = Array.from(handle)
changing[0].style.display = 'block'

handle.forEach((item)=>{
    item.addEventListener('click',()=>{
        let index = handle.indexOf(item)

        handle.forEach((e)=>{
            e.classList.remove('active')
        })

        changing.forEach((e)=>{
            e.style.display='none'
        }) 

        item.classList.add('active')
        changing[index].style.display = 'block'
      
    })
})

// showlabeler

// show shoowee
let showee = document.querySelector('.showee')
showee.addEventListener('click',()=>{
    showee.classList.toggle('showProg2')
})

let labeler = document.querySelector('.labeler')
labeler.addEventListener('click',()=>{
    labeler.parentElement.classList.toggle('nowshow')
})
// mark
let marker = document.querySelectorAll('.mark')
marker = Array.from(marker)
marker.forEach((item)=>{
    item.addEventListener('click',()=>{
        item.parentElement.classList.toggle('showmark2')
    })
})

// adder

let adder = document.querySelectorAll('.adder p')
adder = Array.from(adder)
adder.forEach((item)=>{
    item.addEventListener('click',()=>{
        item.parentElement.classList.toggle('adder2')
    })
})

// accordion

// accordion
const labels = document.getElementsByClassName('label')
const contentBx = document.getElementsByClassName('contentBx')
for (let i = 0; i < labels.length; i++) {
    labels[i].addEventListener('click',()=>{
        contentBx[i].classList.toggle('alive')
    })
    
}