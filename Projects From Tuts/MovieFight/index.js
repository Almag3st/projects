const fetchData = async (searchTerm) => {
    const res = await axios.get('http://www.omdbapi.com/', {
        params: {
            apikey: keys.API_KEY,
            s: searchTerm,
        }
    })

    console.log(res.data)
};


const input = document.querySelector('input');
let timeoutId;
const onInput = (event) => {
    if (timeoutId) {
        clearTimeout(timeoutId);
    }

    timeoutId = setTimeout(() => {
        fetchData(event.target.value);
    }, 1000)

};

input.addEventListener('input', onInput);