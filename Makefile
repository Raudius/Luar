ANTLR_VERSION:=4.9.3
BUILD_TOOLS_DIR:=$(CURDIR)/build

antlr-build:
	mkdir -p $(BUILD_TOOLS_DIR)
	wget -c -O $(BUILD_TOOLS_DIR)/antlr.jar https://www.antlr.org/download/antlr-$(ANTLR_VERSION)-complete.jar
	java -jar $(BUILD_TOOLS_DIR)/antlr.jar -o src/Parser -Dlanguage=PHP Lua.g4 -package "Raudius\Luar\Parser" -visitor -no-listener
