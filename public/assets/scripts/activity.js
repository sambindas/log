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
