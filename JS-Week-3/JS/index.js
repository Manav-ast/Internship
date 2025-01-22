// console.log("Hello World");



// let user = {
//     name: "John",
//     surname: "Smith",
//     age: 35
// }
// console.log(user);

// user.name = "Pete";
// console.log(user.name);

// delete user.name;
// console.log(user);



// let schedule = {};

// console.log(isEmpty(schedule)); // true

// schedule["8:30"] = "get up";

// console.log(isEmpty(schedule)); // false

// function isEmpty(obj) {
//     for (let key in obj) {
//         return false;
//     }
//     return true;
// }


// before the call
// let menu = {
//     width: 200,
//     height: 300,
//     title: "My menu"
// };

// multiplyNumeric(menu);


// console.log(menu);
// // after the call
// menu = {
//     width: 400,
//     height: 600,
//     title: "My menu"
// };

// function multiplyNumeric(obj) {
//     for (let key in obj) {
//         if (typeof obj[key] == 'number') {
//             obj[key] *= 2;
//         }
//     }
// }


// array

const myArr = [0, 1, 2, 3, 4, 5]
const myHeors = ["shaktiman", "naagraj"]

const myArr2 = new Array(1, 2, 3, 4)
// console.log(myArr[1]);

// Array methods

// myArr.push(6)
// console.log(myArr);

// myArr.push(7)
// console.log(myArr);
// myArr.pop()
// console.log(myArr);

// myArr.unshift(9)
// console.log(myArr);
// myArr.shift()
// console.log(myArr);

// console.log(myArr.includes(9));
// console.log(myArr.indexOf(3));

// const newArr = myArr.join()

// console.log(myArr);
// console.log(newArr);


// slice, splice

// console.log("A ", myArr);

// const myn1 = myArr.slice(1, 3)

// console.log(myn1);
// console.log("B ", myArr);


// const myn2 = myArr.splice(1, 3)
// console.log("C ", myArr);
// console.log(myn2);


// console.log(Array.isArray("Hitesh"))
// console.log(Array.from("Manav"))
// console.log(Array.from({ name: "hitesh" })) // interesting

// let score1 = 100
// let score2 = 200
// let score3 = 300

// console.log(Array.of(score1, score2, score3));



// let user = { name: "John" };
// let admin = { name: "Admin" };

// function sayHi() {
//     console.log(this.name);
// }

// // use the same function in two objects
// user.f = sayHi;
// console.log(user);

// admin.f = sayHi;
// console.log(admin);
// // these calls have different this
// // "this" inside the function is the object "before the dot"
// user.f(); // John  (this == user)
// admin.f(); // Admin  (this == admin)

// admin['f'](); // Admin (dot or square brackets access the method – doesn't matter)



// let calculator = {
//     read() {
//         this.a = +prompt('Enter first number', 0);
//         this.b = +prompt('Enter second number', 0);
//     },
//     sum() {
//         return this.a + this.b;
//     },
//     mul() {
//         return this.a * this.b;
//     }
// };

// calculator.read();
// alert(calculator.sum());
// alert.log(calculator.mul());


// let ladder = {
//     step: 0,
//     up() {
//         this.step++;
//         return this;
//     },
//     down() {
//         this.step--;
//         return this;
//     },
//     showStep: function () { // shows the current step
//         alert(this.step);
//         return this;
//     }
// };

// console.log(ladder
//     .up()
//     .up()
//     .down()
//     .showStep()
//     .down()
//     .showStep());



// const xhr = new XMLHttpRequest();
// xhr.onreadystatechange = function () {
//     if (xhr.readyState === 4) {
//         if (xhr.status === 200) {
//             const jsonData = JSON.parse(xhr.responseText);
//             console.log(jsonData);
//         } else {
//             console.error("Error: " + xhr.status);
//         }
//     }
// };
// xhr.onerror = function () {
//     console.error("Network Error");
// };
// xhr.open("GET", "https://jsonplaceholder.typicode.com/posts", true);
// xhr.send();


const xhr = new XMLHttpRequest();
const postsElement = document.getElementById("posts");

xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        const posts = JSON.parse(xhr.responseText);
        displayPosts(posts);
    }
};
xhr.open("GET", "https://jsonplaceholder.typicode.com/posts", true);
xhr.send();
function displayPosts(posts) {
    posts.forEach(post => {
        const postItem = document.createElement("li");
        postItem.innerText = `${post.title} - ${post.body}`;
        postsElement.appendChild(postItem);
    });
}