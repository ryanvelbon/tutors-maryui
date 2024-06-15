<div x-data="{ selectedOption: '' }" class="px-4 h-screen pt-16 md:pt-32">
    <div class="space-y-8">
        <h2 class="text-center text-4xl">🎊 Welcome aboard! 🎊</h2>
        <p class="text-center">Let's set up your profile. Start by telling us whether you're a student or a tutor.</p>
        <div class="mx-auto max-w-3xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <label for="option1" class="cursor-pointer peer">
                    <div class="h-48 select-none border border-2 p-4 flex flex-col items-center justify-center gap-2 text-gray-600" :class="selectedOption === 'student' ? 'border-primary border-4 bg-white text-primary font-bold' : 'bg-gray-200 hover:bg-gray-100'">
                        <span class="text-7xl">👩‍🎓</span>
                        <span class="text-xl">I am a student</span>
                    </div>
                    <input type="radio" id="option1" name="option-group" value="student" x-model="selectedOption" wire:model.live="accountType" class="sr-only peer" />
                </label>
                <label for="option2" class="cursor-pointer peer">
                    <div class="h-48 select-none border border-2 p-4 flex flex-col items-center justify-center gap-2 text-gray-600" :class="selectedOption === 'tutor' ? 'border-primary border-4 bg-white text-primary font-bold' : 'bg-gray-200 hover:bg-gray-100'">
                        <span class="text-7xl">👨‍🏫</span>
                        <span class="text-xl">I am a tutor</span>
                    </div>
                    <input type="radio" id="option2" name="option-group" value="tutor" x-model="selectedOption" wire:model.live="accountType" class="sr-only peer" />
                </label>
            </div>
        </div>
        <div class="text-center text-gray-500 text-xl">
            <p wire:loading>Loading...</p>
        </div>
    </div>
</div>
