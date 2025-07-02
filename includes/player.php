<footer class="fixed bottom-0 left-0 w-full bg-neutral-900 border-t border-neutral-800 h-24 flex items-center justify-between px-4 z-20">
    <div class="flex items-center space-x-4 w-1/4">
        <img id="albumArtFooter" src="https://placehold.co/64x64/121212/121212/png" alt="Song Cover" class="w-16 h-16 rounded-md">
        <div>
            <p id="songTitleFooter" class="text-white text-sm font-semibold">Selecciona una canción</p>
            <p id="artistNameFooter" class="text-neutral-400 text-xs">...</p>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center w-2/4">
        <div class="flex items-center space-x-6 mb-2">
            <button id="prevBtn" class="text-neutral-400 hover:text-white">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M15.707 4.293a1 1 0 010 1.414L7.414 14H12a1 1 0 110 2H3a1 1 0 01-1-1V5a1 1 0 112 0v4.586l8.293-8.293a1 1 0 011.414 0z" clip-rule="evenodd" transform="scale(-1, 1) translate(-18, 0)"></path></svg>
            </button>
            <button id="playPauseBtn" class="bg-white text-black p-2 rounded-full hover:scale-105 transition duration-200">
                <svg id="playPauseIcon" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.025A1 1 0 008 8v4a1 1 0 001.555.975l3.5-2a1 1 0 000-1.95l-3.5-2z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <button id="nextBtn" class="text-neutral-400 hover:text-white">
                 <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M15.707 4.293a1 1 0 010 1.414L7.414 14H12a1 1 0 110 2H3a1 1 0 01-1-1V5a1 1 0 112 0v4.586l8.293-8.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <div class="flex items-center w-full max-w-xl space-x-2">
            <span id="currentTime" class="text-xs text-neutral-400">0:00</span>
            <div id="progressBarContainer" class="flex-grow bg-neutral-600 rounded-full h-1 group relative cursor-pointer">
                <div id="progressBar" class="bg-white h-1 rounded-full"></div>
                <div id="progressHandle" class="w-3 h-3 bg-white rounded-full absolute top-1/2 -translate-y-1/2 -translate-x-1/2 cursor-pointer shadow opacity-0 group-hover:opacity-100" style="left: 0%;"></div>
            </div>
            <span id="totalDuration" class="text-xs text-neutral-400">0:00</span>
        </div>
    </div>

    <div class="flex items-center space-x-2 w-1/4 justify-end">
        <button id="volumeIcon" class="text-neutral-400 hover:text-white">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2.9c.83 0 1.5.67 1.5 1.5v9.2c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5V4.4c0-.83.67-1.5 1.5-1.5zM4 7.4c.83 0 1.5.67 1.5 1.5v2.2c0 .83-.67 1.5-1.5 1.5S2.5 12.43 2.5 11.6V8.9c0-.83.67-1.5 1.5-1.5zm12 0c.83 0 1.5.67 1.5 1.5v2.2c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5V8.9c0-.83.67-1.5 1.5-1.5z"></path>
            </svg>
        </button>
        <div class="w-full max-w-xs">
             <input 
                id="volumeSlider" 
                type="range" 
                min="0" 
                max="1" 
                step="0.01" 
                value="1" 
                class="w-full h-1 bg-neutral-600 rounded-lg appearance-none cursor-pointer slider-thumb"
                style="background: linear-gradient(to right, #1DB954 0%, #1DB954 100%, #535353 100%, #535353 100%);"
            >
        </div>
    </div>
</footer>

