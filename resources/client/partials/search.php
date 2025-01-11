<section class="p-8">
    <form action='' method='GET' class='container flex justify-center items-center'>
        <input type='search' class='p-4 text-lg rounded-l w-full md:w-6/12 border border-divide-gray-500 mr-[-5px]' name='search' placeholder='Pesquisar...' value='<?php echo isset(requests()->search) ? requests()->search : '' ?>'>
        
        <button title="Submeter pesquisa" type='submit' class='input-group-text p-4 text-lg bg-color-main border border-color-main text-white rounded-r id='search'>
            <i class='bi bi-search fs-xs'></i>
        </button>
    </form>
</section>
