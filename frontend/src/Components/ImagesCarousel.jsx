import { Splide, SplideSlide } from '@splidejs/react-splide';
import '@splidejs/react-splide/css';

export default function ImagesCarousel(props) {

    const images = props.images;

    return (
        <Splide options={{type: 'loop'}}>
            {Array.isArray(images) && images.map((image, index) => (
                <SplideSlide key={index}>
                    <img src={image} alt={"Image " + index} className="w-full aspect-square sm:aspect-video sm:object-cover sm:object-center"/>
                </SplideSlide>
            ))}
        </Splide>
    )

}