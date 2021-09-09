// to show notification
let parent= document.querySelectorAll('.parent');

parent = Array.from(parent)

parent.forEach((item)=>{
    console.log(item)
    item.addEventListener('click',()=>{
        item.classList.toggle('showus')
    })
})


// showing in modal

let parent2= document.querySelectorAll('.exempt');

parent2 = Array.from(parent2)

parent2.forEach((item)=>{
    console.log(item)
    item.addEventListener('click',()=>{
        item.parentElement.classList.toggle('showing')
    })
})

// shoow filter div

let filt = document.querySelectorAll('.filterDiv')
let filterCont = document.querySelectorAll('.filterPart')
let clear = document.querySelectorAll('.clearAll')

filt = Array.from(filt)
filterCont = Array.from(filterCont)
clear = Array.from(clear)


filt.forEach((item)=>{
    item.addEventListener('click',()=>{
        let index = filt.indexOf(item)
        filterCont[index].classList.toggle('dshow')
        clear[index].classList.toggle('dshow')
    })
})
