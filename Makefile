install:
	composer install
brain-games:
	./bin/brain-games
brain-even:
	./bin/brain-even
validate:
	composer validate
lint:
	composer run-script phpcs -- --standard=PSR12 src bin
brain-calc:
	./bin/brain-calc
brain-gcd:
	./bin/brain-gcd
brain-progression:
	./bin/brain-progression
dump-autoload:
	composer dump-autoload