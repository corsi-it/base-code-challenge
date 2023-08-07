<div>
    @csrf

    <form method="POST" wire:submit.prevent="submit">


        <div class="form-group">
            <label for="email" class="w-50">Email of user to review:</label>
            <input
                type="email"
                id="email"
                name="email"
                required
                class="form-input"
                placeholder="Search for user to review"
                wire:model="email"
            >

            @if(!empty($email))
                <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetList"></div>

                <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
                    @if(!empty($users))
                        @foreach($users as $i => $user)
                            <a  class="list-item" wire:click="setEmail('{{ $user['email'] }}')">{{ $user['email'] }}</a>
                        @endforeach
                    @else
                    @endif
                </div>

            @endif

        </div>


        <div class="form-group">
            <label for="rating" class="w-50">Stars:</label>
            <select id="rating" name="rating" wire:model="rating"  required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comment" class="w-50">Comment:</label>
            <textarea id="comment" name="comment" rows="4" required wire:model="comment"></textarea>
        </div>



        <div class="form-group">
            <button type="submit" class="login-button">Submit Vote</button>
        </div>
    </form>

</div>
