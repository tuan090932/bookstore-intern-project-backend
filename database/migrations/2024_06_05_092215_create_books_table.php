    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateBooksTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('books', function (Blueprint $table) {
                $table->id('book_id');
                $table->string('title', 250);
                $table->unsignedBigInteger('language_id')->nullable();
                $table->integer('num_pages');
                $table->unsignedBigInteger('publisher_id')->nullable();
                $table->unsignedBigInteger('category_id')->nullable();
                $table->string('image');
                $table->text('description')->nullable();
                $table->double('price');
                $table->integer('stock');
                $table->unsignedBigInteger('author_id')->nullable();
                $table->timestamps();

                $table->foreign('language_id')->references('id')->on('languages')->onDelete('set null');
                $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('set null');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
                $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('books');
        }
    }
