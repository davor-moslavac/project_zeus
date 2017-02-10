{{ content() }}

<form method="post" autocomplete="off" action="{{ url("users/changePassword") }}">

    <div class="center scaffold">

        <h2>Change Password</h2>

        {% include "components/Form.volt" %}

    </div>

</form>