const sideMenu = document.querySelector("aside")
const menuButton = document.querySelector("#menu-btn")
const closeBtn = document.querySelector("#close-btn")
const toogler = document.querySelector('.theme-toggler')
const tableMessage = document.querySelector('#table-message')

menuButton.addEventListener('click', () => {
    sideMenu.style.display = 'block'
})
closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none'
})

toogler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables')

    toogler.querySelector('span:nth-child(1)').classList.toggle('active')
    toogler.querySelector('span:nth-child(2)').classList.toggle('active')
})

// Orders.forEach(order => {
//     const tr = document.createElement('tr');
//     const trContent = `
//                     <td>${order.productTransaction}</td>
//                     <td>${order.productAccountNumber}</td>
//                     <td>${order.productAmount}</td>
//                     <td class="${order.productStatus === 'Recusadp' ? 'danger' : order.productStatus === 'Successo' ? 'success' : order.productStatus === 'Pendente' ? 'warning' : 'primary'}">${order.productStatus}</td>
//                     <td class="primary">Detalhes</td>`
//
//     tr.innerHTML = trContent;
//     document.querySelector('table tbody').appendChild(tr)
// })

const xhr = new XMLHttpRequest()

xhr.open('GET', '/api/get-payments/220000002')

xhr.setRequestHeader('Accept', 'application/json')

xhr.onload = () => {
    const data = JSON.parse(xhr.response)
    const result = data.data

    result.forEach(payment => {
        const tr = document.createElement('tr');
        const trContent = `
                    <td>${payment.transaction_id}</td>
                    <td>${payment.imali_account}</td>
                    <td>${payment.amount}</td>
                    <td class="${payment.estado === 'Recusado' ? 'danger' : payment.estado === 'pago' ? 'primary' : payment.estado === 'Pendente' ? 'warning' : 'primary'}">${payment.estado}</td>
                    <td class="primary">
                    <a href="#">  Detalhes</a>
                    </td>`

        tr.innerHTML = trContent;
        document.querySelector('table tbody').appendChild(tr)

    })


}


xhr.onprogress = (event) => {
    tableMessage.innerHTML = 'Carregado';
    tableMessage.style.display = 'none'
}


xhr.send()


// $(window).load(function(){
//     $("#main-menu a").click(function() {
//         $('.active').removeClass('active');
//         $(this).addClass("active");
//     });
// })
const link = document.getElementsByTagName('a')

link.item().addEventListener('click', () => {
    alert('clicado')
})

