<?php


// The widget class
class Greenline_calculator extends WP_Widget {

    // Main constructor
    public function __construct() {
        parent::__construct(
            'Greenline_calculator',
            __( 'GreenLine Calculator', 'text_domain' ),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }

    // The widget form (for the backend )
    public function form( $instance ) {

        // Set widget defaults
        $defaults = array(
            'title'    => '',
            'text'     => '',
            'textarea' => '',
            'checkbox' => '',
            'select'   => '',
        );

        // Parse current settings with defaults
        extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

        <?php
        // Widget Title
        // Check the widget options
        $title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
        $text     = isset( $instance['text'] ) ? $instance['text'] : '';
        $textarea = isset( $instance['textarea'] ) ?$instance['textarea'] : '';
        $select   = isset( $instance['select'] ) ? $instance['select'] : '';
        $checkbox = ! empty( $instance['checkbox'] ) ? $instance['checkbox'] : false;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <?php // Text Field ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Description:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
        </p>

        <?php // Textarea Field ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>"><?php _e( 'Extra Description:', 'text_domain' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea' ) ); ?>"><?php echo wp_kses_post( $textarea ); ?></textarea>
        </p>

        <?php // Checkbox ?>
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>"><?php _e( 'Display Residue Calculator', 'text_domain' ); ?></label>
        </p>

        <?php // Dropdown ?>
<!--        <p>-->
<!--            <label for="--><?php //echo $this->get_field_id( 'select' ); ?><!--">--><?php //_e( 'Select', 'text_domain' ); ?><!--</label>-->
<!--            <select name="--><?php //echo $this->get_field_name( 'select' ); ?><!--" id="--><?php //echo $this->get_field_id( 'select' ); ?><!--" class="widefat">-->
<!--                --><?php
//                // Your options array
//                $options = array(
//                    ''        => __( 'Select', 'text_domain' ),
//                    'option_1' => __( 'Option 1', 'text_domain' ),
//                    'option_2' => __( 'Option 2', 'text_domain' ),
//                    'option_3' => __( 'Option 3', 'text_domain' ),
//                );
//
//                // Loop through options and add each one to the select dropdown
//                foreach ( $options as $key => $name ) {
//                    echo '<option value="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" '. selected( $select, $key, false ) . '>'. $name . '</option>';
//
//                } ?>
<!--            </select>-->
<!--        </p>-->

    <?php }

    // Update widget settings
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
        $instance['text']     = isset( $new_instance['text'] ) ? wp_strip_all_tags( $new_instance['text'] ) : '';
        $instance['textarea'] = isset( $new_instance['textarea'] ) ? wp_kses_post( $new_instance['textarea'] ) : '';
        $instance['checkbox'] = isset( $new_instance['checkbox'] ) ? 1 : false;
        $instance['select']   = isset( $new_instance['select'] ) ? wp_strip_all_tags( $new_instance['select'] ) : '';
        return $instance;
    }

    // Display the widget
    public function widget( $args, $instance ) {

        extract( $args );

        // Check the widget options
        $title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
        $text     = isset( $instance['text'] ) ? $instance['text'] : '';
        $textarea = isset( $instance['textarea'] ) ?$instance['textarea'] : '';
        $select   = isset( $instance['select'] ) ? $instance['select'] : '';
        $checkbox = ! empty( $instance['checkbox'] ) ? $instance['checkbox'] : false;

        // WordPress core before_widget hook (always include )
        echo $args['before_widget'];

        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box">';

        // Display widget title if defined
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }




        // Display something if checkbox is true
        if ( $checkbox ) {
            echo greenline_calculator($text,$textarea);
        }

        echo '</div>';

        // WordPress core after_widget hook (always include )
        echo $args['after_widget'];

    }

}

function greenline_calculator($text,$textarea){
    ob_start();
    ?>
    <div id="block-block-1" class="">

        <h2></h2>

        <div class="content">
            <div class="calculator-outer-wrapper">
                <div class="calculator-inner-wrapper">
                    <div class="calculator-intro-section">
                        <?php
                        // Display textarea field
                        if ( $text ) {
                            echo '<div class="calculator-intro-section-title"><p style="margin-top: 10px;">' . $text . '</p></div>';
                        }
                        ?>
                        <div class="calculator-intro-section-title">So, what is the real cost of 'Residue'?</div>
                        <p>Fill in our our short questionnaire to find out how much Residue will cost your organisation this
                            year?</p>
                        <p style="margin-bottom: 0px">
                            <input type="email" name="email" id="email" value=""
                                   placeholder="Start by entering your email address">
                            <span class="required">*</span>
                            <span id="error"></span>
                            <input type="hidden" name="website" id="website">
                        </p>
                        <div class="intro-final">Note: We would like to contact you about Greenline updates and
                            notifications. You can easily unsubscribe from these at any time.
                        </div>
                    </div>
                    <div id="calculator-questions">
                        <div class="calculator-question-1 calculator-question">
                            <h3>Question 1 of 4</h3>
                            <div class="question-area">
                                <div class="flex-container">Which of the following tend to eat up time, energy and
                                    resources in your organisation:
                                </div>
                                <div class="flex-container" style="margin-left: 10%">
                                    <label class="flex-item"><input class="cal_type" type="checkbox" name="choice2[]"
                                                  value="Unproductive Meetings">
                                        Unproductive Meetings</label>

                                    <label class="flex-item"><input class="cal_type" type="checkbox" name="choice2[]"
                                                  value="Mistakes\ Rework">
                                        Mistakes\Rework</label>
                                    <label class="flex-item"><input class="cal_type" type="checkbox" name="choice2[]"
                                                  value="Irrelevant Emails">
                                        Irrelevant Emails<span></span></label>
                                    <label class="flex-item"><input class="cal_type" type="checkbox" name="choice2[]"
                                                  value="Missed Deadlines">
                                        Missed Deadlines<span></span></label>
                                    <label class="flex-item"><input class="cal_type" type="checkbox" name="choice2[]"
                                                  value="Wasted Resources">
                                        Wasted Resources<span></span></label>
                                    <label class="flex-item"><input class="cal_type" type="checkbox" name="choice2[]"
                                                  value="Misplaced effort">
                                        Misplaced effort<span></span></label>
                                    <label class="flex-item"><input class="cal_type" type="checkbox" name="choice2[]"
                                                  value="Poor Communications">
                                        Poor Communications<span></span></label>
                                    <label class="flex-item"><input class="cal_type" type="checkbox" name="choice2[]"
                                                  value="Politicking\ Positioning">
                                        Politicking\Positioning<span></span></label>
                                    <label class="flex-item"><input class="cal_type" type="checkbox" name="choice2[]"
                                                  value="Conflict Avoidance">
                                        Conflict Avoidance<span></span></label>
                                    <label class="flex-item"><input class="cal_type" type="checkbox" name="choice2[]"
                                                  value="Lack of Commitment">
                                        Lack of Commitment<span></span></label>
                                </div>
                                <button class="next">Next &gt;</button>
                            </div>
                        </div>
                        <div class="calculator-question-2 calculator-question" style="display: none;">
                            <h3>Question 2 of 4</h3>
                            <div class="question-area">
                                <label for="hour" style="font-size: 1.2em">How many hours a week do you spend managing RESIDUE?</label>
                                <select id="hour" name="hour">
                                    <option value="3">0-3hrs</option>
                                    <option value="6">3-6hrs</option>
                                    <option value="9">6-9hrs</option>
                                    <option value="12">9-12hrs</option>
                                    <option value="15">12-15hrs</option>
                                    <option value="18">15-18hrs</option>
                                    <option value="21">18-21hrs</option>
                                    <option value="22">21+hrs</option>
                                </select>
                                <button class="next">Next &gt;</button>
                            </div>
                        </div>
                        <div class="calculator-question-3 calculator-question" style="display: none;">
                            <h3>Question 3 of 4</h3>
                            <div class="question-area">
                                <label for="industry">What industry do you work in?</label>
                                <select id="industry" name="industry">
                                    <option value="25.83">Aerospace</option>
                                    <option value="15">Agriculture</option>
                                    <option value="19.15">Chemical</option>
                                    <option value="31.75">Computer</option>
                                    <option value="19.23">Construction</option>
                                    <option value="19.89">Defense</option>
                                    <option value="24.43">Energy &amp; Utilities</option>
                                    <option value="17.48">Entertainment</option>
                                    <option value="31.27">Financial Services</option>
                                    <option value="16.51">Food Manufacturing</option>
                                    <option value="20.82">Healthcare &amp; Social Assistance</option>
                                    <option value="14.23">Hospitality &amp; Leisure</option>
                                    <option value="34.47">Telecommunications</option>
                                    <option value="28.01">Manufacturing</option>
                                    <option value="27.13">Mass Media</option>
                                    <option value="29.78">Professional Services</option>
                                    <option value="22.3">Other</option>
                                </select>
                                <button class="next">Next &gt;</button>
                            </div>
                        </div>
                        <div class="calculator-question-4 calculator-question" style="display: none;">
                            <h3>Question 4 of 4</h3>
                            <div class="question-area">
                                <label for="people">How many people work within your organisation?</label>
                                <input id="people" name="people">
                                <button class="submit">Submit &gt;</button>
                            </div>
                        </div>



                    </div>


                    <?php
                    // Display textarea field
                    if ( $textarea ) {
                        echo '<div class="residue-footer"><p>' . $textarea . '</p></div>';
                    }else{
                        echo '<div class="residue-footer"><p>Residue is the wasted time due to factors that occur everyday.</p></div>
                    ';
                    }
                    ?>

                    <div id="calculator-result" style="display: none;">
                        <!-- <h3>Result</h3> -->
                        <div class="calulator-result-text-left">
                            <div class="calulator-result-intro">
                                Residue is potentially costing your organisation up to
                            </div>
                            <p></p>
                            <div class="calulator-result-intro2">
                                every year.
                            </div>
                            <br>
                            <div class="calulator-result-message">
                                This is what you spend annually paying people to manage residue in your organisation. Every
                                hour they spend managing RESIDUE is an hour not spent creating REVENUE.
                            </div>
                        </div>
                        <div class="calulator-result-more">
                            <a href="mailto:info@greenlineconversations.com?subject=Residue%20Calculator%20enquiry">Contact us now to see how we can reduce your costs by reducing residue</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $output = ob_get_clean();
    return $output;
}

// Register the widget
function my_register_custom_widget() {
    register_widget( 'Greenline_calculator' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );

// Add Style
function greenline_style() {
    wp_register_style('green_style', plugins_url('css/green_style.css',__FILE__ ));
    wp_enqueue_style('green_style');
    wp_register_script( 'green_script', plugins_url('js/green_script.js',__FILE__ ), array( 'jquery' ));
    wp_enqueue_script('green_script');
}

add_action( 'wp_enqueue_scripts','greenline_style');