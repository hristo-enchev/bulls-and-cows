<div>
    <!-- Container -->
    <div class="container mx-auto">
        <div class="flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-10/12 lg:w-11/12 flex">
                <!-- Col -->
                @if ($rankList->isEmpty())
                    <div class="w-full h-auto bg-gray-400 lg:w-4/12 bg-cover rounded-l-lg"
                        style="background-image: url('{{ asset('images/photo-1517849845537-4d257902454a.jpg') }}');min-height: 520px;">
                        <h2 class="text-center pt-3 text-xl font-extrabold">Empty rank list</h2>
                    </div>
                @else
                    <div class="w-full lg:w-4/12 bg-white p-5 rounded-lg lg:rounded-r-none">
                        <h3 class="pt-4 text-2xl text-center">Ranklist</h3>
                        <table class="table-fixed pt-6">
                            <thead>
                              <tr>
                                <th class="w-4/12 text-left">Name</th>
                                <th class="w-2/12">Attempts</th>
                                <th class="w-2/12">Time</th>
                                <th class="w-4/12">Date</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($rankList as $item)
                                <tr>
                                    <td class="text-left">{{ $item->nickname }}</td>
                                    <td class="text-center">{{ $item->attempts }}</td>
                                    <td class="text-center">{{ $item->time }}</td>
                                    <td class="text-center">{{ $item->created_at->format('d-m-Y') }}</td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                @endif
                <!-- Col -->
                <div class="w-full lg:w-4/12 bg-white p-5">
                    <h3 class="pt-4 text-2xl text-center">Play Bulls&Cows!</h3>
                    <div class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="pt-4 text-md text-center">Guess the numbers! If the matching digits are in their
                                right positions, they are "bulls", if in different positions, they are "cows".</div>
                        </div>
                        <div class="mb-4">
                            <input
                                class="text-center w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="name" type="text" placeholder="Enter you nickname" wire:model="nickname"
                                {{ $start ? 'disabled' : '' }}>
                        </div>
                        <div class="mb-4 md:flex md:justify-between {{ $start == true ? '' : 'invisible' }}">
                            <div class="md:w-3/12 pr-4">
                                <input
                                    class="bg-gray-200 appearance-none border-2 border-gray-200
                                        rounded w-full py-2 px-4 text-gray-700 leading-tight
                                        focus:outline-none focus:bg-white focus:border-purple-500"
                                    type="number" wire:change="setNumber(1, $event.target.value)" wire:model="number1"
                                    {{ $win ? 'disabled' : '' }}>
                            </div>
                            <div class="md:w-3/12 pr-4">
                                <input
                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                    type="number" wire:change="setNumber(2, $event.target.value)" wire:model="number2"
                                    {{ $win ? 'disabled' : '' }}>
                            </div>
                            <div class="md:w-3/12 pr-4">
                                <input
                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                    type="number" wire:change="setNumber(3, $event.target.value)" wire:model="number3"
                                    {{ $win ? 'disabled' : '' }}>
                            </div>
                            <div class="md:w-3/12 pr-4">
                                <input
                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                    type="number" wire:change="setNumber(4, $event.target.value)" wire:model="number4"
                                    {{ $win ? 'disabled' : '' }}>
                            </div>
                        </div>
                        <div class="mb-6 text-center">
                            @if (!$win)
                                @error('number1') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                @error('number2') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                @error('number3') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                @error('number4') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                @error('nickname') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            @endif
                            <button
                                class="mt-5 w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                id="new-game" type="button" wire:click="startGame">
                                New game
                            </button>
                        </div>
                        <hr class="mb-6 border-t" />
                    </div>
                </div>
                <!-- Col -->
                <div class="w-full lg:w-4/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <div class="md:flex md:items-center mb-6 pl-14 pt-14">
                        Attempts: {{ $attempts }}
                    </div>
                    <div class="md:flex md:items-center mb-6 pl-14">
                        Start :
                        {{ !empty($startTime) ? $startTime->setTimezone('Europe/Sofia')->toTimeString() : '' }}
                    </div>
                    <div class="md:flex md:items-center mb-6 pl-14 {{ $win == false ? 'invisible' : '' }}">
                        Found for : {{ $win ? $totalDuration : '' }} seconds
                    </div>
                    <div class="md:flex md:items-center mb-6 pl-14">
                        Bulls: {{ $bulls }}
                    </div>
                    <div class="md:flex md:items-center mb-6 pl-14">
                        Cows: {{ $cows }}
                    </div>
                    @if ($win)
                        <div class="md:flex md:items-center mb-6 pl-14">
                            <h3 class="pt-4 text-2xl text-center">You win!</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
