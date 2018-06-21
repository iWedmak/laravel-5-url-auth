<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UrlAuthSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for mail logs
        Schema::create('{{ $logTable }}', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('token', 255)->index();
            $table->longText('url', 255);
            $table->integer('user_id');
            $table->integer('visits');
            $table->dateTime('lifetime');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('{{ $logTable }}');
    }
}